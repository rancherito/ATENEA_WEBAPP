function fechaLatino(date)
{
	const d = new Date(date);
	const meses = ['ENE', 'FEB', 'MAR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'];
	let mes = meses[d.getMonth()];
	let anio = d.getFullYear();
	let dia = d.getDate();
	return dia + ' ' + mes + ' ' + anio;
}

function Hora(date)
{

	const f = new Date(date);
	let hora = f.getHours()
	const min = f.getMinutes()
	const ampm = hora >= 12 ? 'pm' : 'am';
	hora = hora % 12;
	hora = hora ? hora : 12;
	return (hora < 10 ? '0' + hora : hora) + ':' + (min < 10 ? '0' + min : min) + ampm;
}

function Timeline(timelime, cronograma) {
	
	cronograma.sort((a, b) => (a.fecha > b.fecha) ? 1 : -1)

	timelime.addClass('timelime')
	for (var i in cronograma) {
		const event = cronograma[i]
		const fecha = fechaLatino(event.fecha)
		const hora = Hora(event.fecha)
		const desc = event.description == undefined ? '' : event.description
		timelime.append(`
			<div class="timelime-event">
				<div class="timelime-point"></div>
				<div class="timelime-date">${fecha}</div>
				<div class="timelime-line"></div>
				<div class="timelime-info">
					<div class="timelime-hour timelime-resalt">${hora == '12:00am' ? '' : hora}</div>
					<h4 class=${hora == '12:00am' ? 'timelime-resalt' : ''}>${event.title}</h4>
					<p>${desc}</p>
				</div>
			<div class="timelime-event">
		`)
	}

}
