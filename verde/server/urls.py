from django.conf.urls import url
from django.contrib.auth import views as auth_views
from .views import signup, dashboard, index, register_farmer


urlpatterns = [
    url(r'^register/$', signup, name="register"),
    url(r'^login/$', auth_views.login, name='login'),
    url(r'^logout/$', auth_views.logout, {'next_page': '/'}, name="logout"),
    url(r'^dashboard/$', dashboard, name="dashboard"),
    url(r'^register-farmer/$', register_farmer, name="register-farmer"),
    url(r'^soil-test/$', register_farmer, name="soil-test"),
    url(r'^sms/$', register_farmer, name="sms"),
    url(r'^voice/$', register_farmer, name="voice"),
    url(r'^reports/$', register_farmer, name="reports"),
    url(r'', index, name="landing"),
]