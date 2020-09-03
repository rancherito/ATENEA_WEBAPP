Vue.component('Smain',{
	template: `
		<div id="divider-main">
			<div ref="cmain" id="content-main" :class="{'content-auto': center}">
				<slot></slot>
			</div>
		</div>
	`,
	props: ['center'],
	mounted: function () {
		this.$emit('content', this.$refs.cmain)
	}
})

/*
	PROPS
	additem: dispara una funcion cuando se haga click en agregar
	onsearch: dispara un funcion cuando se escribe en el buscador
	placeholder: modificacion el tecto del placeholder del buscador
	namemodule: modifica en nombre del modulo
	canadd: bandera que indica si el boton de añador estara visible
*/
Vue.component('main-search',{
	template: `
		<div id="divider-main">
			<div ref="cmain" id="content-main">
				<div class="container">
					<div id='barsearch'>
						<div id='content-barsearch' v-if="!notsearch">
							<input id='search' class='searchinput' :placeholder="placeholder" v-model="search">
							<a id='add-item' class='f-c waves-effect waves-light' @click="add" v-if="!notadd"><i class='fal fa-plus'></i></a>
						</div>
						<h2 class='title-module'>{{namemodule}}</h2>
					</div>
					<div class="space-32"></div>
					<slot></slot>
				</div>

			</div>
		</div>
	`,
	data: function () {
			return {
				search: ''
			}
	},
	props: {
		additem: Function,
		placeholder: {
			type: String,
			default: 'BUSCAR'
		},
		namemodule: {
			type: String,
			default: 'Nombre Modulo'
		},
		notadd: Boolean,
		notsearch: Boolean
	},
	watch: {
			search: function (val) {
				this.$emit('search', val)
			}
	},
	methods: {
			add: function (e) {
				this.$emit('additem', e)
			}
	},
	mounted: function () {
		new SimpleBar( this.$refs.cmain, { autoHide: false });
	}
})
Vue.component('Soption',{
	template: `
		<div id="divider-option" class="f-c">
			<slot></slot>
		</div>
	`
})
