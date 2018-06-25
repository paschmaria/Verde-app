from django.conf.urls import url
from django.contrib.auth import views as auth_views
from .views import *
# from .views import signup, dashboard, index, register_farmer, profile, farmers_demography, farmers_overview, soil_test

urlpatterns = [
    url(r'^register/$', signup, name="register"),
    url(r'^login/$', auth_views.login, name='login'),
    url(r'^logout/$', auth_views.logout, {'next_page': '/'}, name="logout"),
    url(r'^dashboard/$', dashboard, name="dashboard"),
    url(r'^profile/$', profile, name="profile"),
    url(r'^register-farmer/$', register_farmer, name="register-farmer"),
    url(r'^soil-test/$', soil_test, name="soil-test"),
    url(r'^nutrient/$', nutrient, name="nutrient"),
    url(r'^resources/$', resources, name="resources"),
    
    url(r'^sms/$', sms_view, name="sms"),
    url(r'^sms-draft/$', sms_draft_view, name="sms-draft"),
    url(r'^sms-reports/$', sms_reports_view, name="sms-reports"),
    url(r'^sms-history/$', sms_history_view, name="sms-history"),
    url(r'^sms-trash/$', sms_trash_view, name="sms-trash"),
    
    url(r'^voice/$', voice_view, name="voice"),
    url(r'^voice-draft/$', voice_draft_view, name="voice-draft"),
    url(r'^voice-reports/$', voice_reports_view, name="voice-reports"),
    url(r'^voice-history/$', voice_history_view, name="voice-history"),
    url(r'^voice-trash/$', voice_trash_view, name="voice-trash"),
    url(r'^voice-reply/$', voice_reply, name="voice-reply"),
    
    url(r'^reports/$', reports, name="reports"),
    url(r'^market-log/$', market_log, name="market-log"),
    url(r'^farmers/overview$', farmers_overview, name="farmers-overview"),
    url(r'^farmers/bio-data$', farmers_overview, name="farmers-bio-data"),
    url(r'^farmers/demography$', farmers_demography,
        name="farmers-demography"),
    url(r'^farmers/crop-info$', farmers_overview, name="farmers-crop-info"),
    url(r'', index, name="landing"),
]