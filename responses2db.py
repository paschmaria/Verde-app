import csv

with open('recommendation.csv') as csvfile:
    readCSV = csv.reader(csvfile, delimiter=',')
    dates = []
    colors = []
    for row in readCSV:
        crop, fertility, nutrient = row[1], row[3], row[4]
        nutrient_rate, urea_rate, can_rate, p205_rate, ssp_rate, k20_rate = row[5], row[6], row[7], row[8], row[9], row[10]
        mop_rate, zone, application, npk_rate, tsp_rate, bo_rate = row[11], row[12], row[13], row[14], row[15], row[18]

    print(dates)
    print(colors)