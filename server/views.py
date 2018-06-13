import json

from django.contrib.auth.decorators import login_required
from django.shortcuts import render, redirect
from django.contrib.auth import login, authenticate
from django.contrib.auth.forms import UserCreationForm
from django.forms import modelformset_factory

import cloudinary
import cloudinary.api
import cloudinary.uploader

from .forms import SignUpForm, RegFarmerForm
from .models import FarmPicture, FarmerManager, Farmer
# Create your views here.


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

def calc_land_area(value, unit):
    """
        1 => square metre
        2 => acre
        3 => hectare
    """
    if unit=="1":
        return float(int(value))
    
    if unit=="2":
        return float(int(value) * 4046.86)

    if unit=="3":
        return float(int(value) * 1000)
 
def calc_production_volume(value, unit):
    """
        1 => kilogram
        2 => Tonne
    """
    if unit=="1":
        return float(int(value))

    if unit=="2":
        return float(int(value) * 1000)

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
            farmer = form.save(commit = False)
            farmer.extension_worker = request.user
            farmer.location = "{},{}".format(latitude, longitude)
            
            land_area = calc_land_area(land_value, land_unit)
            print("land_area => ",land_area)
            farmer.land_area = land_area

            annual_production_volume = calc_production_volume(volume_value, volume_unit)
            print("prod_volume", annual_production_volume)
            farmer.annual_production_volume = annual_production_volume

            farmer.birth_date = "{}-{}-{}".format(birth_year, birth_month, birth_day)
            
            print(farmer)
            farmer.save()

            for image in request.FILES.getlist('farm_picture'):
                picture = FarmPicture.objects.create(farmer=farmer, picture=image)

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

    return render(request, "farmer-demography.html", {
        "house_data": house_data,
        "edu_data": edu_data,
        "age_data": age_data,
        "gender_data": gender_data,
    })

@login_required
def farmers_overview(request):
    return render(request, 'farmer-overview.html')

@login_required
def soil_test(request):
    return render(request,'soil-test.html')

@login_required
def nutrient(request):
    return render(request,'nutrient.html')

@login_required
def resources(request):
    return render(request,'resources.html')

#=========================SMS VIEWS=========================
@login_required
def sms_view(request):
    return render(request, 'sms.html')

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
    return render(request, 'voice.html')

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

#===================SMS VIEWS=====================

@login_required
def profile(request):
    return render(request, 'profile.html')


@login_required
def reports(request):
    return render(request, 'reports.html')
