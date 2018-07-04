from django.contrib import admin

# Register your models here.
from .models import Profile, Farmer, FarmPicture, SMS, SoilRecommend, SoilTestData

admin.site.register(Profile)
admin.site.register(Farmer)
admin.site.register(FarmPicture)
admin.site.register(SMS)
admin.site.register(SoilRecommend)
admin.site.register(SoilTestData)
