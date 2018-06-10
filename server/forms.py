from django import forms
from django.forms import ModelForm
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User
from .models import Farmer

class SignUpForm(UserCreationForm):
    
    class Meta:
        model = User
        fields = ('username', 'email', 'password1', 'password2')

class RegFarmerForm(ModelForm):
    
    class Meta:
        model = Farmer
        fields = '__all__'
        exclude = ('birth_date', 'extension_worker', 'land_area', 'annual_production_volume')
        