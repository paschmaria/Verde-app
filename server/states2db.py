from .constants import STATES, ZONES
from .models import State, Lga, Zone


def update_states():
    for state_item in STATES:
        state = state_item['state']
        lgas_list = state["locals"]
        state_instance, created = State.objects.get_or_create(
            name=state["name"])
        if created:
            print("Created state ==>", state_instance.name)
            for lga_item in lgas_list:
                lga_instance = Lga.objects.create(
                    name=lga_item["name"], state=state_instance)
                print("==> Adding lga {} to state {}".format(
                    lga_instance.name, state_instance.name))


def update_zones():
    for zone_item in ZONES:
        zone = zone_item['zone']
        states_list = zone["states"]
        zone_instance, created = Zone.objects.get_or_create(name=zone["name"])
        if created:
            print("Created zone ==>", zone_instance.name)
            for state_item in states_list:
                print(state_item)
                state_instance = State.objects.filter(
                    name__icontains=state_item["name"])
                if state_instance:
                    print("==> Adding State {} to Zone {}".format(
                        state_instance[0].name, zone_instance.name))
                    
                    zone_instance.states.add(state_instance[0])
