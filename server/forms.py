from django import forms
from django.forms import ModelForm
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User
from .models import Farmer, FarmPicture

class SignUpForm(UserCreationForm):
    
    class Meta:
        model = User
        fields = ('username', 'email', 'password1', 'password2')

class RegFarmerForm(ModelForm):

    def clean_phone_number(self):
        data = self.cleaned_data['phone_number']
        #convert phone number to +234 format
        data = '+234' + data[1:]
        return data 
    
    def clean_phone_number_2(self):
        data = self.cleaned_data['phone_number_2']
        #convert phone number to +234 format
        data = '+234' + data[1:]
        return data

    class Meta:
        model = Farmer
        fields = '__all__'
        exclude = ('birth_date', 'extension_worker', 'land_area', 'annual_production_volume')
        
# class FarmPicturesForm(forms.ModelForm):
#     class Meta:
#         model = FarmPicture
#         fields = ('farm_picture', )