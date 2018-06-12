from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.utils import timezone

from cloudinary.models import CloudinaryField
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



class FarmerManager(models.Manager):
    def get_queryset(self):
        return super(EmployeeManager, self).get_queryset()

    def gender_data(self):
        no_of_females = self.get_queryset().filter(gender="f").count()
        no_of_males = self.get_queryset().filter(gender="m").count()
        return {"males_count": no_of_males, "females_count": no_of_females}
    
    def age_data(self):
        """
            x1, x2, x3 represent different age ranges
            as at time of coding, x1 < 45, x2 = 45-60, x3>60
        """
        x1 = self.get_queryset().filter(age__lt = 45)
        x2 = self.get_queryset().filter(age__gt = 45, age__lt=60)
        x3 = self.get_queryset().filter(age__gt = 60)
        pass


class Farmer(models.Model):
    GENDERS = (
        ('m', 'Male'),
        ('f', 'Female')
    )

    EDU_LEVELS = (
        ('1', 'None'),
        ('2', 'Quaranica'),
        ('3', 'Primary'),
        ('4', 'Secondary'),
        ('5', 'Tertiary'),
    )

    first_name = models.CharField(max_length=120, blank=True)
    last_name = models.CharField(max_length=120, blank=True)
    phone_number = models.CharField(max_length=120, blank=True)
    phone_number_2 = models.CharField(max_length=120, blank=True)
    email = models.EmailField()
    birth_date = models.DateField(null=True)
    age = models.IntegerField(null=True, blank=True)
    picture = CloudinaryField('image', null=True)

    gender = models.CharField(max_length=1, choices =GENDERS)
    state = models.CharField(max_length=120, blank=True)
    family_size = models.IntegerField()
    annual_income = models.IntegerField(blank=True, null=True)
    max_edu_level = models.CharField(max_length=120, blank=True, choices=EDU_LEVELS)
    location = models.CharField(max_length=120, blank=True)
    town = models.CharField(max_length=120, blank=True)
    
    land_area = models.FloatField(blank=True, null=True)
    planted_crops = models.CharField(max_length=120, blank=True)
    source_of_labour = models.CharField(max_length=120, blank=True)
    annual_production_volume = models.FloatField(blank=True, null=True)

    extension_worker = models.ForeignKey(User, related_name='reg_farmers')

    objects = models.Manager()
    active_objects = FarmerManager()

    def save(self, *args, **kwargs):
        if not self.age:
            age = timezone.now().year - self.birth_date.year
            self.age = age
        super().save(*args, **kwargs)

    def __str__(self):
        return "{} {}".format(self.first_name, self.last_name)


class FarmPicture(models.Model):
    picture = CloudinaryField()
    farmer = models.ForeignKey('Farmer', related_name="farm_pics",on_delete=models.CASCADE)

