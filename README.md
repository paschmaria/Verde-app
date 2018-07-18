Setup instructions
-------------------


- Install virtualenv and create a virtual environment named `venv`
  
    ` pip install virtualenv`
    
    `python3 -m virtualenv venv`

- Activate your virtual environment and install the necessary packages

    `. venv/bin/activate`

    `pip install -r requirements.txt`

- If you have issues setting up a postgresql database,  head over to verde\settings.py, Uncomment the first DATABASES variable and comment the second one

- Setup your migrations and update your db using

    `python manage.py makemigrations`

    `python manage.py migrate`

- Start the Django server

    `python manage.py runserver`

- Head over to `localhost:8000`


Populate Soil Recommendations
-----------------------------

- make sure you've setup migrations and update your db for SoilRecommend model

    `python manage.py makemigrations`

    `python manage.py migrate`

- Start Django server
    `python manage.py runserver`

- Head over to /update-recommends , your db will be updated accordingly

Suggested fixes
---------------

- Please change the vale of the data-value attribute in farmer age cell (farmer-biodata.html) to reflect farmer.age/100
- The chart for 'Distribution by Land Area' isn't dislaying properly, I tried to check what was exactly wrong to no avail. Can you check it out?
- What d'you suggest we do with the map? I'm thinking of using something else. Check out https://developers.arcgis.com/get-started/
- Soil recommendation returns only the crops, it doesn't show the recommendation
- Can you generate the responses for notifications so I'll style the way they are displayed? Like when you register a farmer, when you analyse soil samples etc.
- Secondary Phone number is an optional field and may not be provided during registration. display it optionally in the biodata page (and profile page). Also, consider the case where number is registered using +234-, instead of 0-.