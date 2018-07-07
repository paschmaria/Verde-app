let zone_field = document.querySelector("#zone"); //select zone field
let state_select = document.querySelector("#state-select"); //select state field
let town_select = document.querySelector("#town-select");

//data here has been declared in lga_data.js
let states_list = data.map(res => res.state.name); //get states_list

// get list of lgas
function lga_list(state_name) {
  let state_item;
  for (let state of data) {
    if (state.state.name == state_name) {
      state_item = state.state;
    }
  }
  if (state_item) {
    return state_item.locals.map(res => {
      return res.name;
    });
  }
  return null;
}

for (let state of states_list) {
  state_select.options[state_select.options.length] = new Option(state, state);
}

//update zones field
function updateZone(state) {
  let eco_zone;

  zones = zones_data.map(zone => {
    let name = zone.zone.name;
    let states = zone.zone.states.map(x => x.name);
    return { [name]: states };
  });

  for (let zone of zones) {
    //format of state is => Adamawa State, split removes the state part
    let state = state_select.value.split(" ")
    
    if (state.length > 2){
      state = state[0] + " " + state[1]
      console.log("state is " , state)
    }else{
      state = state[0]
    }

    if (Object.values(zone)[0].indexOf(state) != -1) {
      console.log("it got here")
      eco_zone = eco_zone
        ? `${eco_zone}, ${Object.keys(zone)[0]}`
        : `${Object.keys(zone)[0]}`;
    }
  }

  if (eco_zone) {
    zone_field.value = eco_zone
  }
}

//update town Select field
function updateTownSelect(state_name) {
  town_list = lga_list(state_name);
  town_select.options.length = 1;

  if (zone_field) {
    updateZone(state_name);
  }

  if (!town_list) {
    return;
  }

  for (let town of town_list) {
    town_select.options[town_select.options.length] = new Option(town, town);
  }

  return;
}
