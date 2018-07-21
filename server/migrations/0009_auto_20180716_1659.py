# -*- coding: utf-8 -*-
# Generated by Django 1.11 on 2018-07-16 16:59
from __future__ import unicode_literals

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('server', '0008_auto_20180715_0837'),
    ]

    operations = [
        migrations.CreateModel(
            name='Lga',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=120)),
            ],
        ),
        migrations.CreateModel(
            name='State',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(max_length=120)),
            ],
        ),
        migrations.AddField(
            model_name='lga',
            name='state',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='server.State'),
        ),
    ]
