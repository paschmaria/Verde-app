# -*- coding: utf-8 -*-
# Generated by Django 1.11 on 2018-06-30 13:30
from __future__ import unicode_literals

import cloudinary.models
from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
    ]

    operations = [
        migrations.CreateModel(
            name='Farmer',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('first_name', models.CharField(blank=True, max_length=120)),
                ('last_name', models.CharField(blank=True, max_length=120)),
                ('phone_number', models.CharField(blank=True, max_length=120, unique=True)),
                ('phone_number_2', models.CharField(blank=True, max_length=120, unique=True)),
                ('email', models.EmailField(max_length=254, unique=True)),
                ('birth_date', models.DateField(null=True)),
                ('age', models.IntegerField(blank=True, null=True)),
                ('picture', cloudinary.models.CloudinaryField(max_length=255, null=True, verbose_name='image')),
                ('gender', models.CharField(choices=[('m', 'Male'), ('f', 'Female')], max_length=1)),
                ('state', models.CharField(blank=True, max_length=120)),
                ('family_size', models.IntegerField()),
                ('annual_income', models.IntegerField(blank=True, null=True)),
                ('max_edu_level', models.CharField(blank=True, choices=[('1', 'None'), ('2', 'Quaranica'), ('3', 'Primary'), ('4', 'Secondary'), ('5', 'Tertiary')], max_length=120)),
                ('location', models.CharField(blank=True, max_length=120)),
                ('town', models.CharField(blank=True, max_length=120)),
                ('land_area', models.FloatField(blank=True, null=True)),
                ('planted_crops', models.CharField(blank=True, max_length=120)),
                ('source_of_labour', models.CharField(blank=True, max_length=120)),
                ('annual_production_volume', models.FloatField(blank=True, null=True)),
                ('message_cost', models.FloatField(blank=True, default=0)),
                ('extension_worker', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='reg_farmers', to=settings.AUTH_USER_MODEL)),
            ],
        ),
        migrations.CreateModel(
            name='FarmPicture',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('picture', cloudinary.models.CloudinaryField(max_length=255)),
                ('farmer', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='farm_pics', to='server.Farmer')),
            ],
        ),
        migrations.CreateModel(
            name='Profile',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('bio', models.TextField(blank=True)),
                ('picture', cloudinary.models.CloudinaryField(max_length=255, null=True, verbose_name='image')),
                ('address', models.TextField(blank=True)),
                ('phone_number', models.CharField(blank=True, max_length=120)),
                ('birth_date', models.DateField(blank=True, null=True)),
                ('gender', models.CharField(blank=True, choices=[('m', 'Male'), ('f', 'Female')], max_length=1)),
                ('max_edu_level', models.CharField(blank=True, max_length=120)),
                ('residence_state', models.CharField(blank=True, max_length=120)),
                ('lga', models.CharField(blank=True, max_length=120)),
                ('degree', models.CharField(blank=True, max_length=120)),
                ('user', models.OneToOneField(on_delete=django.db.models.deletion.CASCADE, related_name='profile', to=settings.AUTH_USER_MODEL)),
            ],
        ),
        migrations.CreateModel(
            name='SMS',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('recipient', models.CharField(blank=True, max_length=120)),
                ('sender_id', models.CharField(blank=True, max_length=120)),
                ('status', models.CharField(blank=True, choices=[('delivered', 'Delivered'), ('pending', 'Pending'), ('failed', 'Failed'), ('draft', 'Draft')], max_length=100)),
                ('message_id', models.CharField(blank=True, max_length=120)),
                ('cost', models.FloatField(blank=True)),
                ('message', models.TextField(blank=True)),
                ('sent_date', models.DateTimeField(null=True)),
                ('user', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='messages', to=settings.AUTH_USER_MODEL)),
            ],
        ),
    ]