import json

from django.contrib.auth.decorators import login_required
from django.shortcuts import render, redirect
from django.contrib.auth import login, authenticate
from django.contrib.auth.forms import UserCreationForm
from django.utils import timezone
from django.http import HttpResponse
from django.views.decorators.csrf import csrf_exempt

import cloudinary
import cloudinary.api
import cloudinary.uploader

import africastalking

from .forms import SignUpForm, RegFarmerForm, SoilTestForm
from .models import FarmPicture, FarmerManager, Farmer, SMS
from .responses2db import update_recommendations
from .utils import getRecommends
# Create your views here.

username = "sandbox"
api_key = "df87d659362b259c8e8b7ac1f814f352817bf3278f5306da6d98028672e8fbc9"
africastalking.initialize(username, api_key)


def calc_land_area(value, unit):
    """
        1 => square metre
        2 => acre
        3 => hectare
    """
    if unit == "1":
        return float(int(value))

    if unit == "2":
        return float(int(value) * 4046.86)

    if unit == "3":
        return float(int(value) * 1000)


def calc_production_volume(value, unit):
    """
        1 => kilogram
        2 => Tonne
    """
    if unit == "1":
        return float(int(value))

    if unit == "2":
        return float(int(value) * 1000)


def calc_sample_size(value, unit):
    """
        1 => mg
        2 => g  ==> stored in grams
        3 => kg
    """
    if not float(value):
        return 0

    if unit == "1":
        return float(value) / 1000

    if unit == "2":
        return float(value)

    if unit == "3":
        return float(value) * 1000


def index(request):
    if request.user.is_authenticated():
        return redirect('dashboard')

    else:
        return render(request, template_name="index.html")


def signup(request):
    if request.method == 'POST':
        print(request.POST)
        form = SignUpForm(request.POST)
        if form.is_valid():
            form.save()
            username = form.cleaned_data.get('username')
            raw_password = form.cleaned_data.get('password1')
            user = authenticate(username=username, password=raw_password)
            login(request, user)
            return redirect('dashboard')
        print(form.errors)
        return render(request, 'registration/signup.html', {'form': form})
    else:
        form = SignUpForm()
    return render(request, 'registration/signup.html', {'form': form})


@login_required
def dashboard(request):

    return render(request, 'dashboard.html')


def upload_image(image):
    if image:

        result = cloudinary.uploader.upload(image)
        print(result)
        print(dir(result))

        return False

        return json.dumps(result)
    return False


@login_required
def register_farmer(request):

    if request.method == 'POST':
        print("post request came")
        print(request.FILES)
        print(request.POST)

        latitude = request.POST.get('latitude')
        longitude = request.POST.get('longitude')
        land_value = request.POST.get('land_value')
        land_unit = request.POST.get('land_unit')
        volume_value = request.POST.get('volume_size')
        volume_unit = request.POST.get('volume_unit')
        birth_day = request.POST.get('birth_day')
        birth_month = request.POST.get('birth_month')
        birth_year = request.POST.get('birth_year')

        print("vol_value", volume_value)

        form = RegFarmerForm(request.POST, request.FILES)

        if form.is_valid():
            farmer = form.save(commit=False)
            farmer.extension_worker = request.user
            farmer.location = "{},{}".format(latitude, longitude)

            land_area = calc_land_area(land_value, land_unit)
            print("land_area => ", land_area)
            farmer.land_area = land_area

            annual_production_volume = calc_production_volume(
                volume_value, volume_unit)
            print("prod_volume", annual_production_volume)
            farmer.annual_production_volume = annual_production_volume

            farmer.birth_date = "{}-{}-{}".format(birth_year, birth_month,
                                                  birth_day)

            print(farmer)
            farmer.save()

            for image in request.FILES.getlist('farm_picture'):
                picture = FarmPicture.objects.create(
                    farmer=farmer, picture=image)

            return redirect('register-farmer')

        print(form.errors)
        return render(request, "register-farmer.html", {'form': form})

    else:
        form = RegFarmerForm()
        return render(request, "register-farmer.html", {'form': form})

    return render(request, "register-farmer.html")


@login_required
def farmers_demography(request):

    house_data = Farmer.active_objects.house_data()
    edu_data = Farmer.active_objects.edu_data()
    age_data = Farmer.active_objects.age_data()
    gender_data = Farmer.active_objects.gender_data()
    land_data = Farmer.active_objects.land_data()

    return render(
        request, "farmer-demography.html", {
            "house_data": house_data,
            "edu_data": edu_data,
            "age_data": age_data,
            "gender_data": gender_data,
            "land_data": land_data
        })


@login_required
def farmers_overview(request):
    return render(request, 'farmer-overview.html')


@login_required
def soil_test(request):

    farmers_names = Farmer.active_objects.names_data(user=request.user)
    form = SoilTestForm()

    if request.method == 'POST':
        print("post request came")
        #print(request.FILES)
        print(request.POST)

        nutrient_ratings = {
            "nitrogen": request.POST.get('nitrogen', ""),
            "carbon": request.POST.get('carbon', ""),
            "potassium": request.POST.get('potassium', ""),
            "phosphorus": request.POST.get('phosphorus', ""),
            "zinc": request.POST.get('zinc', ""),
        }

        print("zone => ", request.POST.get('zone', ' 0'))

        sample_size = calc_sample_size(
            float(request.POST.get('sample_size', 0)),
            request.POST.get('sample_unit', '2'))

        print(sample_size)

        land_value = request.POST.get('land_value')
        land_unit = request.POST.get('land_unit')

        fertilizer_day = request.POST.get('fertilizer_day')
        fertilizer_month = request.POST.get('fertilizer_month')
        fertilizer_year = request.POST.get('fertilizer_year')

        state = request.POST.get('state')
        town = request.POST.get('town')

        form = SoilTestForm(request.POST, request.FILES)

        if form.is_valid():
            soil_test = form.save(commit=False)
            soil_test.nutrient_ratings = str(nutrient_ratings)
            soil_test.sample_size = sample_size
            soil_test.last_fertilizer_app = "{}-{}-{}".format(
                fertilizer_year, fertilizer_month, fertilizer_day)
            soil_test.farm_size = calc_land_area(land_value, land_unit)
            soil_test.location = str({'state': state, 'town': town})

            soil_test.save()

            # print(soil_test)
            # print(soil_test.zone)

        else:
            print("errors ==> ", form.errors)
            return render(request, 'soil-test.html', {
                "form": form,
                "farmers_names": farmers_names
            })

    return render(request, 'soil-test.html', {
        "form": form,
        "farmers_names": farmers_names
    })


@login_required
def nutrient(request):
    farmers_names = Farmer.active_objects.names_data(user=request.user)

    if request.method == 'POST':
        if request.POST.get('farmer_id'):
            farmer = Farmer.objects.filter(id=request.POST.get('farmer_id'))
            
            if not farmer:
                return

            soil_tests = farmer[0].soil_tests.all()

            recommends = [getRecommends(test) for test in soil_tests]
            from pprint import pprint
            pprint(recommends)

        return render(request, 'nutrient.html', {'farmers_names': farmers_names, 'recommends': recommends})    

    return render(request, 'nutrient.html', {'farmers_names': farmers_names})


@login_required
def resources(request):
    return render(request, 'resources.html')


#=========================SMS VIEWS=========================
@login_required
def sms_view(request):

    phone_data = Farmer.active_objects.phone_data(user=request.user)

    if request.method == 'POST':
        print(request.POST)
        recipients = request.POST['recipients'].split(',')
        message = request.POST['message']
        sender_id = request.POST['from']

        sms = africastalking.SMS

        print(list(recipients))
        response = sms.send(message, recipients)

        recipients_response = response['SMSMessageData']['Recipients']
        '''
            Once sms has been sent, create a new instance of SMS model
            with the data
        '''

        print(recipients_response)

        for data in recipients_response:
            status = data['status']
            sent_date = timezone.now()
            if status == "Success":
                cost = float(
                    data['cost'].split(' ')[1]
                )  #cost is in format "NGN 2.20" this converts it to float 2.2
                receiver = data['number']
                message_id = data['messageId']

                SMS.objects.create(
                    cost=cost,
                    recipient=receiver,
                    status="delivered",
                    message_id=message_id,
                    message=message,
                    sent_date=send_date,
                    user=request.user)
                continue

            SMS.objects.create(
                cost=cost,
                recipient=receiver,
                status="failed",
                message_id=message_id,
                message=message,
                sent_date=sent_date,
                user=request.user)

        print(response)

    return render(request, 'sms.html', {'phone_data': phone_data})


@login_required
def sms_draft_view(request):
    return render(request, 'sms-drafts.html')


@login_required
def sms_trash_view(request):
    return render(request, 'sms-trash.html')


@login_required
def sms_reports_view(request):
    return render(request, 'sms-reports.html')


@login_required
def sms_history_view(request):
    return render(request, 'sms-history.html')


#===================SMS VIEWS=====================


#=========================VOICE VIEWS=========================
@login_required
def voice_view(request):
    phone_data = Farmer.active_objects.phone_data(user=request.user)

    return render(request, 'voice.html', {'phone_data': phone_data})


@login_required
def voice_draft_view(request):
    return render(request, 'voice-drafts.html')


@login_required
def voice_trash_view(request):
    return render(request, 'voice-trash.html')


@login_required
def voice_reports_view(request):
    return render(request, 'voice-reports.html')


@login_required
def voice_history_view(request):
    return render(request, 'voice-history.html')


#@login_required
@csrf_exempt
def voice_reply(request):
    voice = africastalking.Voice

    response = '<?xml version="1.0" encoding="UTF-8"?>'
    response += '<Response>'
    response += '<Say>Paschal is a boss</Say>'
    response += '</Response>'

    # response = '''
    #         <?xml version="1.0" encoding="UTF-8"?>
    #         <Response>
    #         <Say>Good evening Boss</Say>
    #         </Response>
    #     '''

    if request.method == 'GET':
        result = voice.call(
            source="+2348184372762", destination="+2347062390301")
        print(result)

    if request.method == 'POST':
        print(request.POST)
        return HttpResponse(response, content_type='text/plain')

    return HttpResponse(status=200)


#===================SMS VIEWS=====================


@login_required
def profile(request):
    return render(request, 'profile.html')


@login_required
def reports(request):
    return render(request, 'reports.html')


@login_required
def market_log(request):
    return render(request, 'market-log.html')


@login_required
def update_recommends(request):
    update_recommendations()
    return render(request, 'reports.html')
