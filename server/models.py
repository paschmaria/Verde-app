from django.db import models
from django.contrib.auth.models import User
from django.db.models.signals import post_save
from django.dispatch import receiver
from django.utils import timezone
from django.dispatch import receiver

from datetime import datetime

from cloudinary.models import CloudinaryField
# Create your models here.
    

class Profile(models.Model):
    GENDERS = (
        ('m', 'Male'),
        ('f', 'Female')
    )
    user = models.OneToOneField(User, related_name="profile", on_delete=models.CASCADE)
    bio = models.TextField(blank=True)
    picture = CloudinaryField('image', null=True)
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


class SMS(models.Model):
    STATUS = (
        ('delivered', 'Delivered'),
        ('pending', 'Pending'),
        ('failed', 'Failed'),
        ('draft', 'Draft')
    )
    user = models.ForeignKey(User, related_name="messages",on_delete=models.CASCADE)
    recipient = models.CharField(max_length=120, blank=True)
    sender_id = models.CharField(max_length=120, blank=True)
    status = models.CharField(max_length=100, choices=STATUS, blank=True)
    message_id = models.CharField(max_length=120, blank=True)
    cost = models.FloatField(blank=True)
    message = models.TextField(blank=True)
    sent_date = models.DateTimeField(auto_now=False,null=True)
    # read = models.BooleanField(default=False) #by default messages are unread

@receiver(post_save, sender=SMS)
def update_message_cost(sender, instance, created, **kwargs):
    if not instance.cost:
        profile = Profile.objects.get(user=instance.user)
        profile.message_cost += instance.cost
        profile.save()




class FarmerManager(models.Manager):
    def get_queryset(self):
        return super(FarmerManager, self).get_queryset()

    def gender_data(self):
        no_of_females = self.get_queryset().filter(gender="f").count()
        no_of_males = self.get_queryset().filter(gender="m").count()
        return [no_of_females, no_of_males]
    
    def age_data(self):
        """
            x1, x2, x3 represent different age ranges
            as at time of coding, x1 < 45, x2 = 45-60, x3>60
        """
        x1 = self.get_queryset().filter(age__lt = 45).count()
        x2 = self.get_queryset().filter(age__gte = 45, age__lt=60).count()
        x3 = self.get_queryset().filter(age__gte = 60).count()
        
        return [x1, x2, x3]

    def edu_data(self):
        data = self.get_queryset()
        none = data.filter(max_edu_level='1').count()
        quaranica = data.filter(max_edu_level='2').count()
        primary = data.filter(max_edu_level='3').count()
        secondary = data.filter(max_edu_level='4').count()
        arabic = data.filter(max_edu_level='5').count()

        return [none, quaranica, primary, secondary, arabic]

    def land_data(self):
        """
            x ==> land area in hectares
            y ==> number of farmers  that are in range x
            r ==> % of farmers (i.e y / total_farmers ) 

            x1 <= 700
            0.7 < x2 <= 1400
            1400 < x3 <= 3500
            3500 < x4 <= 7000
            7000 < x5 <= 14100
        """
        data = self.get_queryset()
        total_farmers = data.count()
        
        

        x1 = data.filter(land_area__lte = 700).count()
        
        x2 = data.filter(land_area__lte = 1400, land_area__gt= 700).count()
        x3 = data.filter(land_area__lte = 3500, land_area__gt= 1400).count()
        x4 = data.filter(land_area__lte = 7000, land_area__gt= 3500).count()
        x5 = data.filter(land_area__lte = 14100, land_area__gt= 7000).count()

        land_data_list = [
                        {'x': 0.7, 'y': x1, 'r': float(x1)/total_farmers if total_farmers else 0},
                        {'x': 0.7, 'y': x2, 'r': float(x2)/total_farmers if total_farmers else 0},
                        {'x': 0.7, 'y': x3, 'r': float(x3)/total_farmers if total_farmers else 0},
                        {'x': 0.7, 'y': x4, 'r': float(x4)/total_farmers if total_farmers else 0},
                        {'x': 0.7, 'y': x5, 'r': float(x5)/total_farmers if total_farmers else 0}, 
                    ]

        return land_data_list

    def house_data(self):
        """
            x1 = >10
            x2 = 8-10
            x3 = 5-7
            x4 = 2-4
            x5 = 1
        """
        data = self.get_queryset()
        x1 = data.filter(family_size__gte = 10).count()
        x2 = data.filter(family_size__lte = 10, family_size__gte= 8).count()
        x3 = data.filter(family_size__lte = 7, family_size__gte= 5).count()
        x4 = data.filter(family_size__lte = 4, family_size__gte= 2).count()
        x5 = data.filter(family_size = 1).count()
        return [x1, x2, x3, x4, x5]

    def phone_data(self, user):
        data = self.get_queryset().filter(extension_worker=user)
        phone_numbers = []
        
        for farmer in data:
            phone_numbers.append({'name': "{} {}".format(farmer.first_name, farmer.last_name), 'phone': farmer.phone_number})
            if farmer.phone_number_2:
                phone_numbers.append({'name': "{} {}".format(farmer.first_name, farmer.last_name), 'phone': farmer.phone_number_2})
        
        return phone_numbers


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
    phone_number = models.CharField(max_length=120, unique=True, blank=True)
    phone_number_2 = models.CharField(max_length=120, unique=True, blank=True)
    email = models.EmailField(unique=True,)
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

    #for the messages
    message_cost = models.FloatField(blank=True, default=0)

    extension_worker = models.ForeignKey(User, related_name='reg_farmers')

    objects = models.Manager()
    active_objects = FarmerManager()

    def save(self, *args, **kwargs):
        if not self.age:
            birth_year = int(self.birth_date.split('-')[0])
            print(birth_year ,type(birth_year))
            age = timezone.now().year - birth_year
            self.age = age
        super().save(*args, **kwargs)

    def __str__(self):
        return "{} {}".format(self.first_name, self.last_name)


class FarmPicture(models.Model):
    picture = CloudinaryField()
    farmer = models.ForeignKey('Farmer', related_name="farm_pics",on_delete=models.CASCADE)

class SoilRecommend(models.Model):
    # FERTILITY_CLASSES = (
    #     ('Low', 'Low'),
    #     ('Medium', 'Medium'),
    #     ('High', 'High'),
    # )

    # NUTRIENTS = (
    #     ('Nitrogen', 'Nitrogen'),
    #     ('Phosphorus', 'Phosphorus'),
    #     ('Potassium', 'Potassium'),
    # )

    crop = models.CharField(max_length=120, blank=True)
    fertility_class = models.CharField(max_length=120, blank=True)
    nutrient = models.CharField(max_length=120, blank=True)
    nutrient_rate = models.CharField(max_length=120, blank=True)
    zone = models.CharField(max_length=200, blank=True)
    fertilizer_rate = models.TextField(blank=True)
    application = models.TextField(blank=True)

    

