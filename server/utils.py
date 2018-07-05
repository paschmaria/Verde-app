import ast 
from .models import SoilRecommend

def getRecommends(soil_test):
    """
        soil test nutrients include nitrogen, phosphorus, zinc, potassium, carbon

        Get the recommendation for a particular soil test

        sample nutrient response
            {"nitrogen": {"application": "", "fertilizer_rates": ""},
            "phosphorus": {"application": "", "fertilizer_rates": ""},
            "zinc": {"application": "", "fertilizer_rates": ""},
            "potassium": {"application": "", "fertilizer_rates": ""},
            "carbon": {"application": "", "fertilizer_rates": ""}

    """

    zones = soil_test.zone.split(',')
    crops = soil_test.planted_crops.split(',')
    print("crops are ==>", crops, '\n\n\n')
    nutrients = ast.literal_eval(soil_test.nutrient_ratings)
    response = {}

    for crop in crops:
        for zone in zones:

            zone_response = {}

            nutrient_response = {}
    
            for nutrient in ["nitrogen", "phosphorus", "zinc", "potassium", "carbon"]:
                fertility_class = "low" if nutrients[nutrient] == "lowest" else nutrients[nutrient]
                soil_recommends = SoilRecommend.objects.filter(crop__iexact=crop, nutrient__iexact=nutrient, fertility_class__iexact=fertility_class, zone__contains=zone)
                
                if not soil_recommends:
                    continue
                
                soil_recommends = soil_recommends[0]
                rates = ast.literal_eval(soil_recommends.fertilizer_rate)
                fertilizer_rates = {}

                #remove fertilizer rates that aren't available
                for rate in rates.items():
                    if rate[1]:
                        fertilizer_rates[rate[0]] = rate[1]

                nutrient_response[nutrient] = {"application": "", "fertilizer_rates": ""}
                nutrient_response[nutrient]["application"] = soil_recommends.application
                nutrient_response[nutrient]["fertilizer_rates"] = fertilizer_rates

            if not nutrient_response:
                continue

            zone_response[zone] = nutrient_response
            print(zone_response)
            print(crop)

        
        response[crop] = nutrient_response
    return response
