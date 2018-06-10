Setup instructions
-------------------


- Install virtualenv and create a virtual environment named `venv`
  
    ` pip install virtualenv`
    
    `python -m virtualenv venv`

- Activate your virtual environment and install the necessary packages

    `source venv\Scripts\activate`

    `pip install -r requirements.txt`

- If you have issues setting up a postgresql database,  head over to verde\settings.py, Uncomment the first DATABASES variable and comment the second one

- Setup your migrations and update your db using

    `python manage.py makemigrations`

    `python manage.py migrate`

- Start the Django server

    `python manage.py runserver`

- Head over to `localhost:8000`
