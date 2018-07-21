let zone_field = document.querySelector("#zone"); //select zone field
let state_select = document.querySelector("#id_state"); //select state field
let lga_select = document.querySelector("#id_lga");

//data here has been declared in lga_data.js
//let states_list = data.map(res => res.state.name); //get states_list

function get_state_info(state_id){
  let state_item;
  for (let state of data) {
    if (state.state.id == state_id) {
      state_item = state.state;
    }
  }

  if (state_item) {
    return state_item
  }

  return null

}

// get list of lgas
function lgas_list(state_id) {
  
  state_item = get_state_info(state_id)

  if (state_item) {
    return state_item.locals;
  }

  return null;
}


//update zones field
function updateZone(state_id) {
  let eco_zone;

  zones = zones_data.map(zone => {
    let name = zone.zone.name;
    let states = zone.zone.states.map(x => x.name);
    return { [name]: states };
  });

  console.log(zones)

  for (let zone of zones) {
    //format of state is => Adamawa State, split removes the state part
    let state = get_state_info(state_id).name
    
    if (Object.values(zone)[0].indexOf(state) != -1) {
      console.log("it got here")
      eco_zone = eco_zone
        ? `${eco_zone}, ${Object.keys(zone)[0]}`
        : `${Object.keys(zone)[0]}`;
    }
  }

  if (eco_zone) {
    require(['jquery', 'selectize'], function ($, selectize) {
      $('#input-tags').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function (input) {
          return {
            value: input,
            text: input
          }
        }
      });
    });
    zone_field.value = eco_zone
  }
}

//update town Select field
function updateLgaSelect(state_id) {
  lga_list = lgas_list(state_id);
  lga_select.options.length = 1;

  if (zone_field) {
    updateZone(state_id);
  }

  if (!lga_list) {
    return;
  }

  for (let lga of lga_list) {
    lga_select.options[lga_select.options.length] = new Option(lga.name, lga.id);
  }

  return;
}
