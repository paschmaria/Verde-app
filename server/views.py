from django.contrib.auth.decorators import login_required
from django.shortcuts import render, redirect
from django.contrib.auth import login, authenticate
from django.contrib.auth.forms import UserCreationForm
from .forms import SignUpForm, RegFarmerForm
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

@login_required
def register_farmer(request):
    if request.method == 'POST':
        print("post request came")
        form = RegFarmerForm(request.POST)
        

        if form.is_valid():
            farmer = form.save(commit = False)
            farmer.extension_worker = request.user
            print(farmer)
            farmer.save()
            return redirect('register-farmer')
        
        print(dir(form.errors))
        return render(request, "register-farmer.html", {'form': form}) 

    else:
        form = RegFarmerForm()
        return render(request, "register-farmer.html", {'form': form})
    
    return render(request, "register-farmer.html")

@login_required
def farmers_demography(request):
    return render(request, "farmer-demography.html")

@login_required
def profile(request):
    return render(request, 'profile.html')