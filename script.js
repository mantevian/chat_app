const add_row_button = document.getElementById('add');
const remove_row_button = document.getElementById('remove');
const row_number_input = document.getElementById('row-input');
const input_feedback = document.getElementById('input-feedback');

let table;

add_row_button.disabled = true;
remove_row_button.disabled = true;
row_number_input.disabled = true;


function create_table() {
	if (table) {
		alert('таблица уже создана');
		return;
	}

	table = document.createElement('table');
	table.setAttribute('id', 'table');
	document.body.appendChild(table);

	add_row_button.disabled = false;
	remove_row_button.disabled = false;
	row_number_input.disabled = false;
	add_row();
}


async function get_random_fact() {
	let response = await fetch(`https://fish-text.ru/get?type=sentence&number=1`);
	let json = await response.json();
	return json.text;
}


function add_row() {
	const row = document.createElement('tr');
	const cell1 = document.createElement('td');
	const count = (table.childElementCount + 1) ?? 1;
	cell1.innerText = count;

	const cell2 = document.createElement('td');
	get_random_fact().then(text => cell2.innerText = text);
	
	row.appendChild(cell1);
	row.appendChild(cell2);
	table.appendChild(row);

	update_input_feedback();
}


function remove_row() {
	const index = row_number_input.value;
	table.removeChild(table.childNodes.item(index - 1));

	update_row_numbers();
	update_input_feedback();
}


function update_row_numbers() {
	for (let i = 0; i < table.childElementCount; i++)
		table.childNodes.item(i).childNodes.item(0).innerText = i + 1;
}


function set_inputs_enabled(value) {
	add_row_button.disabled = !value;
	row_number_input.disabled = !value;
}


function validate_number(n) {
	if (parseInt(n) !== 0 && !parseInt(n))
		return { result: false, feedback: 'это не число' };

	if (n <= 0)
		return { result: false, feedback: 'число меньше 1' };

	if (n > table.childElementCount)
		return { result: false, feedback: 'число слишком большое' };

	return { result: true, feedback: 'OK' };
}


function update_input_feedback() {
	const validate = validate_number(row_number_input.value);

	input_feedback.innerText = validate.feedback;

	if (validate.result === true) {
		input_feedback.classList.remove('validate-false');
		input_feedback.classList.add('validate-true');
		remove_row_button.disabled = false;
	}
	else if (validate.result === false) {
		input_feedback.classList.remove('validate-true');
		input_feedback.classList.add('validate-false');
		remove_row_button.disabled = true;
	}

	select_row(row_number_input.value);
}


function select_row(index) {
	for (let i = 0; i < table.childElementCount; i++)
		if (i == index - 1)
			table.childNodes.item(i).classList.add('selected');
		else
			table.childNodes.item(i).classList.remove('selected');
}