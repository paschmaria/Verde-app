let zone_field = document.querySelector("#zone"); //select zone field
let state_select = document.querySelector("#id_state"); //select state field
let town_select = document.querySelector("#id_lga");

//data here has been declared in lga_data.js
//let states_list = data.map(res => res.state.name); //get states_list

// get list of lgas
function lga_list(state_id) {
  let state_item;
  for (let state of data) {
    console.log(state)
    if (state.state.id == state_id) {
      state_item = state.state;
    }
  }
  if (state_item) {
    return state_item.locals;
  }
  return null;
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
function updateLgaSelect(state_id) {
  town_list = lga_list(state_id);
  town_select.options.length = 1;

  // if (zone_field) {
  //   updateZone(state_name);
  // }

  if (!town_list) {
    return;
  }

  console.log(town_list)

  for (let town of town_list) {
    town_select.options[town_select.options.length] = new Option(town.name, town.id);
  }

  return;
}
