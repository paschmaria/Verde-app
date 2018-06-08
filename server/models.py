from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver
# Create your models here.

class Profile(models.Model):
    GENDERS = (
        ('m', 'Male'),
        ('f', 'Female')
    )
    user = models.OneToOneField(User, related_name="profile", on_delete=models.CASCADE)
    bio = models.TextField(blank=True)
    address = models.TextField(blank=True)
    phone_number = models.CharField(max_length=120, blank=True)
    birth_date = models.DateField(blank=True, null=True)
    gender = models.CharField(max_length=1, blank=True, choices =GENDERS)
    max_edu_level =models.CharField(max_length=120, blank=True)
    residence_state = models.CharField(max_length=120, blank=True)
    lga = models.CharField(max_length=120, blank=True)
    degree = models.CharField(max_length=120, blank=True)

    def __str__(self):
        return "{}'s profile".format(self.user.username)

@receiver(post_save, sender=User)
def update_profile(sender, instance, created, **kwargs):
    if created:
        Profile.objects.create(user=instance)
    instance.profile.save()



class Farmer(models.Model):
    GENDERS = (
        ('m', 'Male'),
        ('f', 'Female')
    )
    
    first_name = models.CharField(max_length=120, blank=True)
    last_name = models.CharField(max_length=120, blank=True)
    phone_number = models.CharField(max_length=120, blank=True)
    phone_number_2 = models.CharField(max_length=120, blank=True)
    email = models.EmailField()
    birth_date = models.DateField()
    gender = models.CharField(max_length=1, choices =GENDERS)
    state = models.CharField(max_length=120, blank=True)
    family_size = models.IntegerField()
    annual_income = models.IntegerField()
    max_edu_level = models.CharField(max_length=120, blank=True)
    location = models.CharField(max_length=120, blank=True)
    land_area = models.FloatField()
    planted_crops = models.CharField(max_length=120, blank=True)
    source_of_labour = models.CharField(max_length=120, blank=True)
    extension_worker = models.ForeignKey(User, related_name='reg_farmers')