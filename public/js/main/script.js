
//console.log("hola");

const modal_constancia = $('#modal_constancia').modal()
const modal_espera = $('#modal_espera').modal()
const lista_errores = $('#lista_errores')
const in_DNI = $('#in_DNI')
const btn_recuperar = $('#btn_recuperar')
const modal_registro = $('#modal_registro').modal()
const p3_swpadre = $('#p3_swpadre')
const p3_swmadre = $('#p3_swmadre')
const p3_swapoderado = $('#p3_swapoderado')

const wp4_snombrecolegio = $('#p4_snombrecolegio');
const wp4_tipocolegio = $('#p4_tipocolegio');
const wp4_inombrecolegio = $('#p4_inombrecolegio');
const btn_AbrirGenerador = $('.btn-AbrirGenerador')
const consCons = $("#btnConsConstancia");
const genCons = $("#btnGenConstancia");
const lista_postulaciones = $('#lista_postulaciones');


function redir() {
	window.open('index.php', '_self');
}
btn_AbrirGenerador.click( e => {
	in_DNI.val('');
	lista_postulaciones.empty()
	modal_constancia.modal('open');
})

function generarLinkConstancias(dni, modalidad, fn) {
	lista_postulaciones.empty()
	in_DNI.val(dni)
	$.post('Servicios/InscripcionActual_listar' , {alumno: dni, modalidad: modalidad}, data => {
		console.log(data);
		for (var i in data) {
			const dat = data[i]
			const templade = $(`
				<form target="_blank" method="post" action="constancia">
				<input type="hidden" name="modalidad" value="${dat.modalidad}">
				<input type="hidden" name="dni" value="${dni}">
				<button class="card-panel bg-secondary white-text btn-list">
				<div>
				<i class="fas fa-file-pdf" style="font-size: 1.5rem"></i>
				<span style="padding-left: 8px; font-size: .9rem;">${dat.nombre_modalidad}</span>
				</div>
				<div class="pulse"></div>
				</button>
				</form>
				`)
				templade.submit( e => {
					setTimeout(function () {location.reload();},2000);

				});
				lista_postulaciones.append(templade)

			}
			if (typeof fn == 'function') fn(data);
		},'json')
	}

	btn_recuperar.click( e => {
		const dni = in_DNI.val();
		if (dni.length == 8 || dni.length == 12) generarLinkConstancias(dni, '%')
		else M.toast({html: 'VERIFIQUE LOS CARACTERES', classes: 'bg-alert'});

	})
	var datainfo = {
		p_modalidad: null,
		p_carrera: null,
		p_carrera2: null,
		p_dni: null,
		p1_appaterno: null,
		p1_apmaterno: null,
		p1_ncompleto: null,
		p1_genero: null,
		p1_fechanacimiento: null,
		p1_pais: null,
		p1_ubigeonacimiento: null,
		p2_cell: null,
		p2_telf: null,
		p2_email: null,
		p2_direccion: null,
		p3_padrenombre: null,
		p3_padredni: null,
		p3_padrecell: null,
		p3_padreocupacion: null,
		p3_padreapellido: null,
		p3_madrenombre: null,
		p3_madredni: null,
		p3_madrecell: null,
		p3_madreocupacion: null,
		p3_madreapellido: null,
		p3_apoderadonombre: null,
		p3_apoderadodni: null,
		p3_apoderadocell: null,
		p3_apoderadoocupacion: null,
		p3_apoderadoapellido: null,
		p4_pais: null,
		p4_nombrecolegio: null,
		p4_anioegreso: null
	};
	var message = new cg.MessageBox();
	function seeNext(num) {
		$(".btn-next-0"+num).click(function(event) {


			if (num === 2) {
				datainfo.p1_appaterno = null;
				datainfo.p1_apmaterno = null;
				datainfo.p1_ncompleto = null;
				datainfo.p1_genero = null;
				datainfo.p1_fechanacimiento = null;
				datainfo.p1_pais = null;
				datainfo.p1_ubigeonacimiento = null;

				var allisValid = true;
				allisValid &= cg.p1_appaterno.isValid();
				allisValid &= cg.p1_apmaterno.isValid();
				allisValid &= cg.p1_ncompleto.isValid();
				allisValid &= cg.p1_genero.isValid();
				allisValid &= cg.p1_dia.isValid();
				allisValid &= cg.p1_mes.isValid();
				allisValid &= cg.p1_anio.isValid();
				allisValid &= cg.p1_pais.isValid();

				datainfo.p1_appaterno = cg.p1_appaterno.val();
				datainfo.p1_apmaterno = cg.p1_apmaterno.val();
				datainfo.p1_ncompleto = cg.p1_ncompleto.val();
				datainfo.p1_genero = cg.p1_genero.val();



				datainfo.p1_pais = cg.p1_pais.val();
				datainfo.p1_fechanacimiento = cg.p1_anio.val() + "-" + cg.p1_mes.val() + "-" + cg.p1_dia.val();

				if (cg.p1_pais.val() === "139") {
					allisValid &= cg.p1_departamento.isValid();
					allisValid &= cg.p1_provincia.isValid();
					allisValid &= cg.p1_distrito.isValid();
					datainfo.p1_ubigeonacimiento = cg.p1_departamento.val() + "-" + cg.p1_provincia.val() + "-" + cg.p1_distrito.val();
				}

				if (allisValid) {
					datainfo.p1_appaterno = datainfo.p1_appaterno.toUpperCase();
					datainfo.p1_apmaterno = datainfo.p1_apmaterno.toUpperCase();
					datainfo.p1_ncompleto = datainfo.p1_ncompleto.toUpperCase();

					$(".formulario_").hide();
					$(".formulario_0"+num).show();
					$(".btn_cont").find("button").removeAttr('style');
					$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
				}

			}
			else if(num === 3) {
				datainfo.p2_cell = null;
				datainfo.p2_telf = null;
				datainfo.p2_email = null;
				datainfo.p2_direccion = null;

				var allisValid = true;
				allisValid &= cg.p2_cell.isValid();
				allisValid &= cg.p2_telf.isValid();
				allisValid &= cg.p2_email.isValid();
				allisValid &= cg.p2_via.isValid();
				allisValid &= cg.p2_direccion.isValid();

				datainfo.p2_cell = cg.p2_cell.val();
				datainfo.p2_telf = cg.p2_telf.val();
				datainfo.p2_email = cg.p2_email.val();
				datainfo.p2_direccion = cg.p2_via.val() + " " + cg.p2_direccion.val();

				if (allisValid) {
					$(".formulario_").hide();
					$(".formulario_0"+num).show();
					$(".btn_cont").find("button").removeAttr('style');
					$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
				}
			}
			else if(num === 4){
				datainfo.p3_padrenombre = null;
				datainfo.p3_padredni = null;
				datainfo.p3_padrecell = null;
				datainfo.p3_madrenombre = null;
				datainfo.p3_madredni = null;
				datainfo.p3_madrecell = null;
				datainfo.p3_apoderadonombre = null;
				datainfo.p3_apoderadodni = null;
				datainfo.p3_apoderadocell = null;

				datainfo.p3_padreocupacion = null;
				datainfo.p3_padreapellido = null;
				datainfo.p3_madreocupacion = null;
				datainfo.p3_madreapellido = null;
				datainfo.p3_apoderadoocupacion = null;
				datainfo.p3_apoderadoapellido = null;

				var allisValid = true;
				var uapodr = false;

				if (p3_swpadre.is(':checked')) {
					allisValid &= cg.p3_padrenombre.isValid();
					allisValid &= cg.p3_padredni.isValid();
					allisValid &= cg.p3_padrecell.isValid();
					allisValid &= cg.p3_padreocupacion.isValid();
					allisValid &= cg.p3_padreapellido.isValid();

					datainfo.p3_padrenombre = cg.p3_padrenombre.val();
					datainfo.p3_padredni = cg.p3_padredni.val();
					datainfo.p3_padrecell = cg.p3_padrecell.val();
					datainfo.p3_padreocupacion = cg.p3_padreocupacion.val();
					datainfo.p3_padreapellido = cg.p3_padreapellido.val();
					uapodr |= true;
				}

				if (p3_swmadre.is(':checked')) {
					allisValid &= cg.p3_madrenombre.isValid();
					allisValid &= cg.p3_madredni.isValid();
					allisValid &= cg.p3_madrecell.isValid();
					allisValid &= cg.p3_madreocupacion.isValid();
					allisValid &= cg.p3_madreapellido.isValid();

					datainfo.p3_madrenombre = cg.p3_madrenombre.val();
					datainfo.p3_madredni = cg.p3_madredni.val();
					datainfo.p3_madrecell = cg.p3_madrecell.val();
					datainfo.p3_madreocupacion = cg.p3_madreocupacion.val();
					datainfo.p3_madreapellido = cg.p3_madreapellido.val();

					uapodr |= true;
				}

				if (p3_swapoderado.is(':checked')) {
					allisValid &= cg.p3_apoderadonombre.isValid();
					allisValid &= cg.p3_apoderadodni.isValid();
					allisValid &= cg.p3_apoderadocell.isValid();
					allisValid &= cg.p3_apoderadoocupacion.isValid();
					allisValid &= cg.p3_apoderadoapellido.isValid();

					datainfo.p3_apoderadonombre = cg.p3_apoderadonombre.val();
					datainfo.p3_apoderadodni = cg.p3_apoderadodni.val();
					datainfo.p3_apoderadocell = cg.p3_apoderadocell.val();
					datainfo.p3_apoderadoocupacion = cg.p3_apoderadoocupacion.val();
					datainfo.p3_apoderadoapellido = cg.p3_apoderadoapellido.val();

					uapodr |= true;
				}

				$("div.notifyApoderado").hide();
				if (!uapodr) $("div.notifyApoderado").show();

				if (uapodr && allisValid) {
					$(".formulario_").hide();
					$(".formulario_0"+num).show();
					$(".btn_cont").find("button").removeAttr('style');
					$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
				}
			}
			else if(num === 5){
				datainfo.p4_pais = null;
				datainfo.p4_nombrecolegio = null;
				datainfo.p4_anioegreso = null;
				var allisValid = true;

				allisValid &= cg.p4_anioegreso.isValid();
				allisValid &= cg.p4_pais.isValid();

				datainfo.p4_pais = cg.p4_pais.val();
				datainfo.p4_anioegreso = cg.p4_anioegreso.val();

				if (cg.p4_pais.val() === "139") {
					allisValid &= cg.p4_departamento.isValid();
					allisValid &= cg.p4_provincia.isValid();
					allisValid &= cg.p4_distrito.isValid();
					allisValid &= cg.p4_snombrecolegio.isValid();

					datainfo.p4_nombrecolegio = cg.p4_snombrecolegio.val();

					if (cg.p4_snombrecolegio.val() === "0000000") {
						allisValid &= cg.p4_tipocolegio.isValid();
						allisValid &= cg.p4_inombrecolegio.isValid();
						datainfo.p4_nombrecolegio = cg.p4_tipocolegio.val()+cg.p4_inombrecolegio.val();
					}
				}else {
					allisValid &= cg.p4_tipocolegio.isValid();
					allisValid &= cg.p4_inombrecolegio.isValid();

					datainfo.p4_nombrecolegio = cg.p4_tipocolegio.val()+cg.p4_inombrecolegio.val();
				}


				if (allisValid) {
					$(".formulario_").hide();
					$(".formulario_0"+num).show();
					$(".btn_cont").find("button").removeAttr('style');
					$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
				}
			}
			else if(num === 6) {
				$(".btn_cont").find("button").removeAttr('style');
				$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
				datainfo.p3_swpadre = p3_swpadre.is(':checked');
				datainfo.p3_swmadre = p3_swmadre.is(':checked');
				datainfo.p3_swapoderado = p3_swapoderado.is(':checked');

				for (var i in datainfo) if (typeof datainfo[i] !== "number" && typeof datainfo[i] !== "boolean" && typeof datainfo[i] !== "string") datainfo[i] = 'null';

				$.post('validar', datainfo, function(data) {
					var DATA = JSON.parse(data);
					if (DATA["valor"].length > 0) M.toast({html: 'ERRORES ENCONTRADOS', classes: 'bg-alert'});
					else {
						modal_registro.modal('close')
						generarLinkConstancias(datainfo.p_dni, datainfo.p_modalidad, function (d) {
							M.toast({html: 'NUEVO REGISTRO EXITOSO', classes: 'bg-secondary'});
							modal_constancia.modal('open')
						})
					}

				});
			}

		});
	}
	function seeBack(num) {

		$(".btn-back-0"+num).click(function(event) {
			$(".btn_cont").find("button").removeAttr('style');
			$("#btn_cont-"+num).find("button").css({background:"#c5234b","transform":"scale(1.2)"});
			$(".formulario_").hide();
			$(".formulario_0"+num).show();
		});
	}
	function addZero(num,length) {
		var s_rtr = "";
		for (var i = 0; i < length - (num+"").length; i++) {
			s_rtr += "0";
		}
		return s_rtr+num;
	};
	$(document).ready(function() {
		const nextForm = $("button.btn-nextForm");
		cg.readyObj();


		seeNext(2);seeBack(1);
		seeNext(3);seeBack(2);
		seeNext(4);seeBack(3);
		seeNext(5);seeBack(4);
		seeNext(6);


		form_p();
		form_1();
		form_2();
		form_3();
		form_4();
		events();

		/*cg.p_tipopostulante.val("1");
		cg.p_dni.val("75258278");
		cg.p1_appaterno.val("ANONIMO TEST");
		cg.p1_apmaterno.val("ANONIMO TEST");
		cg.p1_ncompleto.val("ANONIMO TEST");
		cg.p1_genero.val("1");
		cg.p1_anio.val("2016");
		cg.p1_mes.val("01");
		cg.p1_dia.val("01");
		cg.p2_via.val("JIRON");
		cg.p2_direccion.val("los torrentes");
		cg.p2_cell.val("987654321");

		cg.p3_madrenombre.val("ANONIMO TEST");
		cg.p3_madreapellido.val("ANONIMO TEST");
		cg.p3_madreocupacion.val('AMA DE CASA')
		cg.p3_madredni.val("12345678");
		cg.p3_madrecell.val("987654321");*/

		function form_p() {
			cg.p_modalidad

			.input("cselect")
			.leyenda("MODALIDAD")
			.addItemDB('Servicios/Modalidad_Recuperar',{},{nombre:"nombre", valor: "modalidad"})
			.validation({novalues: ["-1","",null]});

			cg.p_carrera

			.input("cselect")
			.leyenda("CARRERA PROFESIONAL")
			.validation({novalues: ["-1","",null]});

			cg.p_carrera2

			.input("cselect")
			.leyenda("CARRERA (2DA OPCION)");

			cg.p_tipopostulante

			.input("cselect")
			.leyenda("TIPO POSTULANTE")
			.addItemDB('Servicios/Tipopostulante',{},{nombre:"nombre", valor: "tipopostulante"})
			.validation({novalues: ["-1","",null]});

			cg.p_dni
			.leyenda("DNI O CARNET DE EXTRANGERIA")
			.placeholder("ingrese documento de identidad")
			.validation({novoid: true, regex: cg.regex.nums, dimension: [8,12]})

			cg.p_modalidad.input().change(function(event) {
				cg.p_carrera.addItemDB('Servicios/CarreraCiclo_Listar',{modalidad: cg.p_modalidad.val()},{nombre:"nombre", valor: "carrera"})
			});

			cg.p_tipopostulante.input().change(function(event) {
				var val = cg.p_tipopostulante.val();
				var indiPre = "<p>Presentar el documento que acredite la opcion selecionada:</p>";
				$("#notifyBoxIndicaciones").show();
				if (val === "1") $("#notifyBoxIndicaciones").html("<div>NOTA</div>"+indiPre+"<p>•	Constancia impresa de inscripción <br>• recibo de pago <br>•  copia de DNI.</p>");

				else if (val === "2") $("#notifyBoxIndicaciones").html("<div>NOTA</div>"+indiPre+"<p>• CONSTANCIA QUE ACREDITE QUE ES LICENCIADO EN LAS F.F.A.A. DEL PERU.</p>");

				else if (val === "3") $("#notifyBoxIndicaciones").html("<div>NOTA</div>"+indiPre+"<p>• CONSTANCIA QUE ACREDITE QUE ESTA REALIZANDO A CABO EL SERVICIO MILITAR ACUARTELADO.</p>");

				else if (val === "4" || val === "5") $("#notifyBoxIndicaciones").html("<div>NOTA</div>"+indiPre+"<p>• COPIA DEL CONTRATO VIGENTE CON LA UNAMAD.</p>");


			});

			cg.p_carrera.input().change(function(event) {
				console.log(21245454);
				var value = cg.p_carrera.val();
				if (cg.p_modalidad.val() === '1' || cg.p_modalidad.val() === '3') {
					if (value === "ED" || value === "EI" || value === "EP" || value === "EC" || value === "DC" || value === "CF" || value === "AN") {
						cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]}).disabled(false).deleteAllItem().addItem(
							cg.Option("-1","Sin segunda opción"),
							/*cg.Option("ED","EDUCACION ESPECIALIDAD: MATEMATICAS Y COMPUTACION"),
							cg.Option("EI","EDUCACION INICIAL Y ESPECIAL"),
							cg.Option("EP","EDUCACION PRIMARIA E INFORMATICA"),
							cg.Option("EC","ECOTURISMO")*/
						).val("-1");

					}
					else if (value === "IF" || value === "IS") {
						cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]}).disabled(false).deleteAllItem().addItem(
							cg.Option("-1","NINGUNO"),
							cg.Option("IA","INGENIERIA AGROINDUSTRIAL")
						).val("-1");
					}else if (value === "EN") {
						cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]}).disabled(false).deleteAllItem().addItem(
							cg.Option("-1","NINGUNO"),
							cg.Option("MV","MEDICINA VETERINARIA - ZOOTECNIA")
						).val("-1");
					}else if (value === "MV") {
						cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]}).disabled(false).deleteAllItem().addItem(
							cg.Option("-1","NINGUNO"),
							cg.Option("EN","ENFERMERIA")
						).val("-1");
					}else {
						cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]})
						.deleteAllItem()
						.addItem(cg.Option("-1","Sin segunda opción").prop('disabled', true)).val("-1")
						.validation({novalues: ["",cg.p_carrera.val()]});
					}
				}else {
					cg.p_carrera2.validation({novalues: ["",cg.p_carrera.val()]})
					.deleteAllItem()
					.addItem(cg.Option("-1","Sin segunda opción").prop('disabled', true)).val("-1")
					.validation({novalues: ["",cg.p_carrera.val()]});
				}

			});

			cg.p_carrera2.input().change(function(event) {
				cg.p_carrera.validation({novalues: ["-1","",null,cg.p_carrera2.val()]})
			});

		}
		function form_1() {
			cg.p1_appaterno
			.leyenda("APELLIDO PATERNO")
			.placeholder("ingrese apellido paterno")
			.validation({novoid: true, regex:/^[a-záéíóúüñ ]+$/gi})
			;

			cg.p1_apmaterno
			.leyenda("APELLIDO MATERNO")
			.placeholder("ingrese apellido materno")
			.validation({novoid: true, regex:/^[a-záéíóúüñ ]+$/gi})
			;

			cg.p1_ncompleto
			.leyenda("NOMBRE COMPLETO")
			.placeholder("ingrese nombre completo")
			.validation({novoid: true, regex:/^[a-záéíóúüñ ]+$/gi})
			;

			cg.p1_genero
			.leyenda("GENERO")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			.addItem(
				cg.Option("0","FEMENINO"),
				cg.Option("1","MASCULINO")
			)
			;


			cg.p1_dia.leyenda("DIA").input("cselect").validation({novalues: ["-1","",null]})
			;

			for (var i = 1; i <= 31; i++) {
				var day = addZero(i,2);
				cg.p1_dia.addItem(cg.Option(day,day));
			}

			cg.p1_mes.leyenda("MES").input("cselect").validation({novalues: ["-1","",null]})
			;

			var meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
			for (var i = 0; i < meses.length; i++) {
				cg.p1_mes.addItem(cg.Option(addZero(i+1,2),meses[i]));
			}

			cg.p1_anio.leyenda("AÑO").input("cselect").validation({novalues: ["-1",""]})
			;

			for (var i = (new Date).getFullYear(); i >=(new Date).getFullYear()-100; i--) {
				cg.p1_anio.addItem(cg.Option(i,i));
			}

			//seleccion del pais de nacimiento del inscriptor
			cg.p1_pais
			.leyenda("PAIS")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p1_departamento
			.leyenda("DEPARTAMENTO")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p1_provincia
			.leyenda("PROVINCIA")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p1_distrito
			.leyenda("DISTRITO")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			function isPeru(val) {
				var la = val === '139';
				cg.p1_departamento.val('-1');
				cg.p1_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p1_provincia.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');

				if (la) $(".formulario_01").find(".giubigeo").show();
				else $(".formulario_01").find(".giubigeo").hide();



			}
			var dep='-1',dist='-1',prov='-1';

			cg.p1_pais.addItemDB('Servicios/Pais_listar',{},{nombre:"nombre", valor: "pais"},function () {
				isPeru(cg.p1_pais.val());
			});
			cg.p1_pais.input().change(function(event) {
				isPeru(cg.p1_pais.val());
			});

			cg.p1_departamento
			.addItemDB('Servicios/Departamentos_listar',{},{valor:'departamento',nombre:'nombre'});

			cg.p1_departamento.input().change(function (event) {
				dep = cg.p1_departamento.val();
				if (dep !== '-1') cg.p1_provincia.addItemDB('Servicios/Provincia_listar',{ departamento: dep }, {valor:'provincia',nombre:'nombre'}).val('-1');
				else cg.p1_provincia.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p1_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
			});

			cg.p1_provincia.input().change(function(event) {
				prov = cg.p1_provincia.val();
				if (prov !== '-1') cg.p1_distrito.addItemDB('Servicios/Distrito_listar' ,{departamento: dep, provincia: prov } ,{valor:'distrito', nombre:'nombre'}).val('-1');
				else  cg.p1_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
			});

		}
		function form_2() {

			cg.p2_cell
			.leyenda("CELULAR* (9 digt.)")
			.placeholder("ingrese número de celular")
			.validation({dimension: [0,9], regex: cg.regex.nums,novoid: true})
			;

			cg.p2_telf
			.leyenda("TELEFONO")
			.placeholder("ingrese teléfono")
			.validation({dimension: [0,8], regex: cg.regex.nums})
			;

			cg.p2_email
			.leyenda("CORREO ELECTRONICO")
			.placeholder("ingrese correo electronico")
			.validation({regex: cg.regex.email})
			;

			cg.p2_via
			.leyenda("VIA")
			.input("cselect")
			.addItem(
				cg.Option("AVENIDA", "AVENIDA"),
				cg.Option("JIRON", "JIRON"),
				cg.Option("CALLE", "CALLE"),
				cg.Option("PASAJE", "PASAJE"),
				cg.Option("ALAMEDA", "ALAMEDA"),
				cg.Option("MALECON", "MALECON"),
				cg.Option("OVALO", "OVALO"),
				cg.Option("PARQUE", "PARQUE"),
				cg.Option("PLAZA", "PLAZA"),
				cg.Option("CARRETERA", "CARRETERA"),
				cg.Option("CAMINO", "CAMINO"),
				cg.Option("TROCHA", "TROCHA"),
				cg.Option("PROLONGACION", "PROLONGACION"),
				cg.Option("URBANIZACION", "URBANIZACION"),
				cg.Option("PASEO", "PASEO"),
				cg.Option("BOULEVARD", "BOULEVARD"),
				cg.Option("AUTOPISTA", "AUTOPISTA"),
				cg.Option("OTROS", "OTROS")
			)
			.validation({novalues: ["-1","",null]})
			;


			cg.p2_direccion
			.leyenda("DIRECCION")
			.placeholder("ingrese ")
			.disabled(true)
			.validation({regex: cg.regex.alphanums, novoid: true})
			;

		}
		function form_3() {
			cg.p3_padrenombre.leyenda("NOMBRES").placeholder("ingrese nombres")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_padreapellido.leyenda("APELLIDOS").placeholder("ingrese apellidos")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-100"]})
			;

			cg.p3_padredni.leyenda("DOCUMENTO DE IDENTIDAD").placeholder("ingrese documento de identidad")
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,12]})
			;

			cg.p3_padreocupacion.leyenda("OCUPACION").placeholder("ingrese ocupacion")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_padrecell.leyenda("CELULAR/TELEFONO").placeholder("ingrese teléfono o celular")
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,9]})
			;


			cg.p3_madrenombre.leyenda("NOMBRES").placeholder("ingrese nombres")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_madreapellido.leyenda("APELLIDOS").placeholder("ingrese apellidos")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-100"]})
			;

			cg.p3_madredni.leyenda("DOCUMENTO DE IDENTIDAD").placeholder("ingrese documento de identidad")
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,12]})
			;

			cg.p3_madreocupacion.leyenda("OCUPACION").placeholder("ingrese ocupacion")
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_madrecell.leyenda("CELULAR/TELEFONO").placeholder("ingrese teléfono o celular")
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,9]})
			;


			cg.p3_apoderadonombre.leyenda("NOMBRES").placeholder("ingrese nombres").disabled(true)
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_apoderadoapellido.leyenda("APELLIDOS").placeholder("ingrese apellidos").disabled(true)
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-100"]})
			;

			cg.p3_apoderadodni.leyenda("DOCUMENTO DE IDENTIDAD").placeholder("ingrese documento de identidad").disabled(true)
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,12]})
			;

			cg.p3_apoderadoocupacion.leyenda("OCUPACION").placeholder("ingrese ocupacion").disabled(true)
			.validation({regex: cg.regex.words, novoid: true, dimension: ["2-50"]})
			;

			cg.p3_apoderadocell.leyenda("CELULAR/TELEFONO").placeholder("ingrese teléfono o celular").disabled(true)
			.validation({regex: cg.regex.nums, novoid: true, dimension: [8,9]})
			;



			p3_swpadre.change(function(event) {
				var checka = p3_swpadre.is(':checked');
				cg.p3_padrenombre.disabled(!checka).activeNotify(checka);
				cg.p3_padredni.disabled(!checka).activeNotify(checka);
				cg.p3_padrecell.disabled(!checka).activeNotify(checka);
				cg.p3_padreapellido.disabled(!checka).activeNotify(checka);
				cg.p3_padreocupacion.disabled(!checka).activeNotify(checka);

			});

			p3_swmadre.change(function(event) {
				var checka = p3_swmadre.is(':checked');
				cg.p3_madrenombre.disabled(!checka).activeNotify(checka);
				cg.p3_madredni.disabled(!checka).activeNotify(checka);
				cg.p3_madrecell.disabled(!checka).activeNotify(checka);
				cg.p3_madreapellido.disabled(!checka).activeNotify(checka);
				cg.p3_madreocupacion.disabled(!checka).activeNotify(checka);

			});
			p3_swapoderado.change(function(event) {
				var checka = p3_swapoderado.is(':checked');
				cg.p3_apoderadonombre.disabled(!checka).activeNotify(checka);
				cg.p3_apoderadodni.disabled(!checka).activeNotify(checka);
				cg.p3_apoderadocell.disabled(!checka).activeNotify(checka);
				cg.p3_apoderadoapellido.disabled(!checka).activeNotify(checka);
				cg.p3_apoderadoocupacion.disabled(!checka).activeNotify(checka);
				cg.p3_swapoderado.leyenda((checka ? "TIENE OTRO APODERADO" : "NO TIENE OTRO APODERADO"));

			});

		}
		function form_4() {

			//seleccion del pais de nacimiento del inscriptor
			cg.p4_pais
			.leyenda("PAIS")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p4_departamento
			.leyenda("DEPARTAMENTO")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p4_provincia
			.leyenda("PROVINCIA")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p4_distrito
			.leyenda("DISTRITO")
			.input("cselect")
			.validation({novalues: ["-1","",null]})
			;

			cg.p4_tipocolegio.leyenda("TIPO COLEGIO").input("cselect").validation({novalues: ["-1","",null]})

			cg.p4_snombrecolegio.leyenda("COLEGIO").input("cselect").validation({novalues: ["-1","",null]})

			cg.p4_inombrecolegio.leyenda("NOMBRE COLEGIO").placeholder("ingrese nombre del colegio").hide().validation({novoid: true})

			cg.p4_anioegreso.leyenda("AÑO QUE TERMINO SU COLEGIO").input("cselect").validation({novalues: ["-1","",null]})

			for (var i = (new Date).getFullYear(); i >=(new Date).getFullYear()-100; i--) cg.p4_anioegreso.addItem(cg.Option(i,i));

			function isPeru(val) {
				var la = val === '139';
				cg.p4_departamento.val('-1');
				cg.p4_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p4_provincia.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p4_snombrecolegio.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1').show();
				cg.p4_tipocolegio.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1').show(false);
				cg.p4_inombrecolegio.deleteAllItem().show().val('');
				cg.p4_anioegreso.val('-1');
				wp4_snombrecolegio.show()
				wp4_tipocolegio.hide();
				wp4_inombrecolegio.show()
				if (la) {$(".formulario_04").find(".giubigeo").show();}
				else {$(".formulario_04").find(".giubigeo").hide();}

				if (val === '139') {
					cg.p4_inombrecolegio.show(false).deleteAllItem().val('- en espera -');
					wp4_inombrecolegio.hide()
				}else if (val !== '-1') {
					cg.p4_snombrecolegio.show(false);
					cg.p4_tipocolegio.show().deleteAllItem().addItem(
						cg.Option('-1','- Seleccione -'),cg.Option('1','Privada - Particular'),cg.Option('0','Pública - Estatal')
					).val('-1');

					wp4_snombrecolegio.hide();
					wp4_tipocolegio.show();
				}

			}
			var dep='-1',dist='-1',prov='-1';

			cg.p4_pais.addItemDB('Servicios/Pais_listar',{},{nombre:"nombre", valor: "pais"},function () {
				isPeru(cg.p4_pais.val());
			});
			cg.p4_pais.input().change(function(event) {
				isPeru(cg.p4_pais.val());
			});

			cg.p4_departamento
			.addItemDB('Servicios/Departamentos_listar',{},{valor:'departamento',nombre:'nombre'});

			cg.p4_departamento.input().change(function (event) {
				dep = cg.p4_departamento.val();
				if (dep !== '-1') cg.p4_provincia.addItemDB('Servicios/Provincia_listar',{departamento: dep},{valor:'provincia',nombre:'nombre'}).val('-1');
				else cg.p4_provincia.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p4_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');

				cg.p4_snombrecolegio.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p4_inombrecolegio.show(false);
				cg.p4_tipocolegio.deleteAllItem().show(false);
				wp4_inombrecolegio.hide()
				wp4_tipocolegio.hide()
			});

			cg.p4_provincia.input().change(function(event) {
				prov = cg.p4_provincia.val();
				if (prov !== '-1') cg.p4_distrito.addItemDB('Servicios/Distrito_listar',{departamento: dep, provincia: prov},{valor:'distrito',nombre:'nombre'}).val('-1');
				else  cg.p4_distrito.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');

				cg.p4_snombrecolegio.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				cg.p4_inombrecolegio.show(false);
				cg.p4_tipocolegio.deleteAllItem().show(false);
				wp4_inombrecolegio.hide()
				wp4_tipocolegio.hide()
			});

			cg.p4_distrito.input().change(function(event) {
				dist = cg.p4_distrito.val();
				if (dist !== '-1'){
					cg.p4_snombrecolegio.addItemDB('Servicios/Colegio_listar',{ departamento: dep , provincia: prov, distrito: dist },{valor:'colegio',nombre:'nombre'},function () {
						cg.p4_snombrecolegio.addItem(cg.Option('0000000','OTROS')).val('-1');
					});
				}else {
					cg.p4_snombrecolegio.deleteAllItem().addItem(cg.Option('-1','- en espera -')).val('-1');
				}
				cg.p4_inombrecolegio.show(false);
				cg.p4_tipocolegio.deleteAllItem().show(false);
				wp4_inombrecolegio.hide()
				wp4_tipocolegio.hide()
			});

			cg.p4_snombrecolegio.input().change(function(event) {
				var colegio = cg.p4_snombrecolegio.val();
				if (colegio === '-1'){
					cg.p4_tipocolegio.deleteAllItem().show(false);
					cg.p4_inombrecolegio.show(false);
					wp4_inombrecolegio.hide()
					wp4_tipocolegio.hide()
				}else if (colegio === '0000000'){
					cg.p4_tipocolegio.deleteAllItem().addItem(
						cg.Option('-1','- Seleccione -'),cg.Option('1','Privada - Particular'),cg.Option('0','Pública - Estatal')
					).val('-1').disabled(false).show();
					cg.p4_inombrecolegio.show().val('');
					wp4_inombrecolegio.show()
					wp4_tipocolegio.show()
				}else {
					cg.p4_inombrecolegio.show(false);
					cg.p4_tipocolegio.deleteAllItem().show(false);
					wp4_inombrecolegio.hide()
					wp4_tipocolegio.hide()
				}
			});

		}
		function events() {

			nextForm.click(function(event) {
				var allisValid = true;
				allisValid &= cg.p_modalidad.isValid();
				allisValid &= cg.p_carrera.isValid();
				allisValid &= cg.p_carrera2.isValid();
				allisValid &= cg.p_dni.isValid();
				allisValid &= cg.p_tipopostulante.isValid();

				datainfo.p_modalidad = cg.p_modalidad.val();
				datainfo.p_carrera = cg.p_carrera.val();
				datainfo.p_dni = cg.p_dni.val();
				datainfo.p_carrera2 = cg.p_carrera2.val();
				datainfo.p_tipopostulante = cg.p_tipopostulante.val();

				if (allisValid) {

					generarLinkConstancias(datainfo.p_dni, datainfo.p_modalidad, DATA =>{
						console.log(DATA);
						if (DATA.length > 0) {
							in_DNI.val(datainfo.p_dni)
							modal_constancia.modal('open')
							M.toast({html: 'UD. YA ESTA INSCRITO EN ESTA MODALIDAD', classes: 'bg-secondary'});
						}
						else {
							$.post('Servicios/Apoderadoalumno_listar', {dniapoderado: '%', dni: datainfo.p_dni}, function(DATAAP) {
								if (DATAAP.length > 0) {
									for (var i in datainfo) if (typeof datainfo[i] !== "number" && typeof datainfo[i] !== "boolean" && typeof datainfo[i] !== "string") datainfo[i] = 'null';

									$.post('validacionrapida', datainfo, function(DATA_) {
										console.log(DATA_);
										if (DATA_["valor"].length > 0) M.toast({html: 'ERRORES ENCONTRADOS', classes: 'bg-alert'});
										else {

											generarLinkConstancias(datainfo.p_dni, datainfo.p_modalidad, function (d) {
												console.log(d);
												M.toast({html: 'NUEVO REGISTRO EXITOSO', classes: 'bg-secondary'});
												modal_constancia.modal('open')
											})
										}

									},'json');

								}else {
									datainfo.p_carrera2 = datainfo.p_carrera2 === "-1" ? null: datainfo.p_carrera2;
									modal_registro.modal('open')
								}
							}, 'json');

						}
					});
				}
				else {
					datainfo.p_modalidad = null;
					datainfo.p_carrera = null;
					datainfo.p_dni = null;
					datainfo.p_carrera2 = null;
					datainfo.p_tipopostulante = null;
				}
			});
		}

	});
