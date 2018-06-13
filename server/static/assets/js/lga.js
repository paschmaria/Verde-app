function lga_list(state_name) {
  let state_item;
  for (let state of data) {
    if (state.state.name == state_name) {
      state_item = state.state;
    }
  }
  if (state_item) {
    return state_item.locals.map(res => {
      console.log(res);
      return res.name;
    });
  }
  return null;
}

let states_list = data.map(res => {
  return res.state.name;
});

state_select = document.querySelector("#state-select");

console.log(states_list)
for (let state of states_list) {
  state_select.options[state_select.options.length] = new Option(state, state);
  console.log(state)
}

function onStateChange(state_name) {
  town_list = lga_list(state_name);
  town_select = document.querySelector("#town-select");
  town_select.options.length = 1


  if (!town_list) {
    return;
  }
  
  for (let town of town_list) {
    town_select.options[town_select.options.length] = new Option(town, town);
  }
  return;
}
