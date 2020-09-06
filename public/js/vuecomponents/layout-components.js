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
Vue.component('main-module',{
	template: `
		<div id="main-module" :class="{'main-module-crud': isOpenCrud}">
			<div id="main-module-wrapcrud">
				<div id="main-module-crud">
					<slot name="crud"></slot>
				</div>
				<span id="main-module-crud-title">{{crudtitle}}</span>
			</div>
			<div id="main-module-container" class="white">
				<div ref="cmain" id="content-main">
					<div class="container">
						<div id='barsearch'>
							<h2 class='title-color'>{{namemodule}}</h2>
							<div id='content-barsearch' v-if="!notsearch">
								<input id='search' class='searchinput' :placeholder="placeholder" v-model="search">
								<div class="h-space-16" v-if="!notadd"></div>
								<a class='f-c waves-effect waves-light' @click="add" v-if="!notadd"><i class='fal fa-plus'></i></a>
								<div class="h-space-16" v-if="!notFilter"></div>
								<a class='f-c waves-effect waves-light' @click="isOpenFilter = true" v-if="!notFilter"><i class='fal fa-filter'></i></a>
							</div>
						</div>
						<div class="space-32"></div>
						<slot></slot>
					</div>
				</div>
				<div id="main-module-filter" :class="{'main-module-filter-show': isOpenFilter}">
					<a v-if="isOpenFilter" id="main-module-filter-close" @click="isOpenFilter = false">
						<i class="fal fa-angle-right"></i>
					</a>
					<div>
						<slot name="filter"></slot>
					</div>
				</div>
			</div>

		</div>
	`,
	created: function () {
	},
	data: function () {
			return {
				search: '',
				isOpenFilter: false,
				isOpenCrud: false,
				setOpen: set => {
					this.isOpenFilter = set;
				},
				setOpenCrud: set => {
					this.isOpenCrud = set;
				}
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
		crudtitle: {
			type: String,
			default: 'FORMULARIO'
		},
		notadd: Boolean,
		notsearch: Boolean,
		notFilter: Boolean
	},
	watch: {
			search: function (val) {
				this.$emit('search', val)
			}
	},
	methods: {
			add: function (e) {
				this.$emit('additem', e)
				this.isOpenCrud = true
			}
	},
	mounted: function () {
		new SimpleBar( this.$refs.cmain, { autoHide: false });
		this.$emit('openfilter', this.setOpen)
		this.$emit('opencrud', this.setOpenCrud)
	}
})
Vue.component('Soption',{
	template: `
		<div id="divider-option" class="f-c">
			<slot></slot>
		</div>
	`
})
Vue.component('main-search',{
	template: `
		<div id="divider-main" class="white">
			<div ref="cmain" id="content-main">
				<div class="container">
					<div id='barsearch'>
						<div id='content-barsearch' v-if="!notsearch">
							<input id='search' class='searchinput' :placeholder="placeholder" v-model="search">
							<div class="h-space-16"></div>
							<a id='add-item' class='f-c waves-effect waves-light' @click="add" v-if="!notadd"><i class='fal fa-plus'></i></a>
						</div>
						<h2 class='title-color'>{{namemodule}}</h2>
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
