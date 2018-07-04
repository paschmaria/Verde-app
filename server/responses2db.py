import csv
from .models import SoilRecommend

def update_recommendations():
    with open(r'server/recommendation.csv') as csvfile:
        readCSV = csv.reader(csvfile, delimiter=',')
        for row in readCSV:
            crop, fertility_class, nutrient = row[1], row[3], row[4]
            nutrient_rate, urea_rate, can_rate, p205_rate, ssp_rate, k20_rate = row[5], row[6], row[7], row[8], row[9], row[10]
            mop_rate, zone, application, npk_rate, tsp_rate, bo_rate = row[11], row[12], row[13], row[14], row[15], row[18]

            fertilizer_rate = {
                "urea_rate": urea_rate,
                "can_rate": can_rate,
                "p205_rate": p205_rate,
                "ssp_rate": ssp_rate,
                "k20_rate": k20_rate,
                "mop_rate": mop_rate,
                "npk_rate": npk_rate,
                "tsp_rate": tsp_rate,
                "bo_rate": bo_rate,
            }
            
            recommendation = SoilRecommend.objects.create(
                crop = crop,
                nutrient = nutrient,
                fertility_class = fertility_class,
                zone = zone,
                application=application,
                nutrient_rate = nutrient_rate,
                fertilizer_rate = str(fertilizer_rate)
            )
            print("created recommendation for crop =>{}, fertility=>{}, zone={}".format(crop, fertility_class, zone) )

    

# import ast
# ast.literal_eval()