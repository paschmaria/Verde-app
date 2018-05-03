var app_users,sms,voice,sales,farmer,soil_sample;

app_users = {
  "admin": { "username": "admin", "password": "PlurimusAdmin18" },
  "agent": {
   "firstname": "",
    "lastname": "",
    "username": "",
    "password": "",
   "phone_num": { "primary": "", "secondary": "" },
       "email": "",
         "DOB": { "day": "", "month": "", "year": "" },
      "gender": "",
   "education": ""
  }
}

farmer = {
   "firstname": "",
    "lastname": "",
   "phone_num": { "primary": "", "secondary": "" },
       "email": "",
         "DOB": { "day": "", "month": "", "year": "" },
      "gender": "",
   "education": "",
 "family_size": "",
"av_ann_income": "",
       "state": "",
        "town": "",
   "farm_long": "",
    "farm_lat": "",
   "farm_size": "",
 "farm_images": ["link1","link2","link3","link4"], // images would be uploaded as links 
  "farm_crops": ["","","...",""],
  "av_prod_vol": {
    "farm_crops[1]": "",
    "farm_crops[2]": "",
    "farm_crops[i]": ""
  },
"source_of_labour": ["",""]
}

soil_sample = {
    "farmer_name": farmer.firstname + farmer.lastname,
          "state": farmer.state,
           "town": farmer.town,
 "fert_appl_date": { "day": "", "month": "", "year": "" },
    "sample_size": "",
 "amt_of_samples": "",
"field_size_sample": "",
   "sample_depth": "",
   "sample_equip": "",
      "soil_type": ["","","...",""]
}

sms = {
  "farmer_name": farmer.firstname + farmer.lastname,
        "phone": farmer.phone_num.primary,
"sender_number": "",
      "message": "",
"date_of_message": "",
"time_of_message": "",
"delivery_report": "",
       "drafts": "",
        "trash": ""
}

voice = {
  "farmer_name": farmer.firstname + farmer.lastname,
        "phone": farmer.phone_num.primary,
"sender_number": "",
      "message": "link", // calls (recorded voices) would be uploaded as links
 "date_of_call": "",
 "time_of_call": "",
"delivery_report": {
 "received_calls": "",
   "missed_calls": "",
   "busied_calls": ""
},
       "drafts": "",
        "trash": ""
}

sales = {
  "farmer_name": farmer.firstname + farmer.lastname,
        "state": farmer.state,
         "town": farmer.town,
        "phone": farmer.phone_num.primary,
    "commodity": {
       "type": "",
        "qty": "",
      "price": ""
    },
    "status": [{
         "paid": { "delivered": true },
      "pending": false
    }]
}