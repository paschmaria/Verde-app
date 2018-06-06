from django.contrib import admin

# Register your models here.
from .models import Profile, Farmer

admin.site.register(Profile)
admin.site.register(Farmer)