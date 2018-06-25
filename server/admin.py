from django.contrib import admin

# Register your models here.
from .models import Profile, Farmer, FarmPicture, SMS

admin.site.register(Profile)
admin.site.register(Farmer)
admin.site.register(FarmPicture)
admin.site.register(SMS)