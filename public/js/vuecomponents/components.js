Vue.component('list-filter',{
	props: ['name', 'check', 'onchange'],
	computed: {
		onCheck: {
            get: function() {return this.check},
            set: function(value) {this.$emit('changecheck', value)}
        }
    },
	template: `
	<div class="list-filter">
		{{name}}
		<label>
			<input type="checkbox" class="filled-in" v-model="onCheck" @change="on_check">
			<span></span>
		</label>
	</div>
	`,
	methods: {
		on_check: function (val) {
			if (typeof this.onchange == 'function') {
				this.onchange(val)
			}

		}
	}
})
Vue.component('searchbox',{
	props: ['dataset','on_change', 'on_select'],
	template: `
	<label class="searchBox2">
		<input ref="input" type="text" v-model="value" placeholder="buscar" @keyup.enter="onEnter"><i class="fa fa-search" ></i>
		<div ref="dropdown" class="searchBox2-dropdown-content" v-show="isOpenDropdown">
			<a v-if="dataset.length == 0" class="searchBox2-option-void">SIN RESULTADOS</a>
			<a v-for="d in dataset" @click="onClick(d)">{{d.text}}</a>
		</div>
	</label>`,
	data: function () {
		return {
			isOpenDropdown: false,
			value: ''
		}
	},
	methods: {
		updatePosition: function () {
	        let pos = this.$el.getBoundingClientRect();
			this.$refs['dropdown'].style.top = (pos.top + this.$el.offsetHeight - 3) + 'px'
			this.$refs['dropdown'].style.left = pos.left + 'px'
			this.$refs['dropdown'].style.width = this.$el.offsetWidth + 'px'

	    },
		onClick: function (d) {
			if (typeof this.on_select == 'function') this.on_select(d)
			this.isOpenDropdown = false
		},
		onFocus: function () {
			this.onChange()
			this.updatePosition()
		},
		onEnter: function () {
			if (this.isOpenDropdown) {if (this.dataset.length) this.onClick(this.dataset[0])}
			else this.onChange()
		},
		onChange: function () {
			this.isOpenDropdown = this.value.length > 0
			if (typeof this.on_change == 'function') this.on_change(this.value)
		}
	},
	watch: {
		value: function (value) {
			this.onChange()
		}
	},
	mounted: function () {
		this.$refs['input'].addEventListener('focus',this.onFocus)
		document.body.appendChild(this.$refs['dropdown']);
		window.addEventListener('click', e => {if (e.target !== this.$refs['input']) this.isOpenDropdown = false;})
		window.addEventListener('scroll', this.updatePosition)
		window.addEventListener('resize', this.updatePosition)

		this.$refs['dropdown'].addEventListener('click',function (e) {e.stopPropagation();})
	}

})
Vue.component('loader',{
	template: `
	<div class="loader" v-if="time > 0">
		<div class="sk-folding-cube"><div class="sk-cube1 sk-cube"></div> <div class="sk-cube2 sk-cube"></div> <div class="sk-cube4 sk-cube"></div> <div class="sk-cube3 sk-cube"></div></div>
		<span>CARGANDO...</span>
	</div>
	`,
	created: function () {
		if (this.show) this.time = 2
	},
	data: function () {
		return {
			time: 0
		}
	},
	props: ['show'],
	watch: {
		show: function (val) {
			if (val) {
				this.time = 2
			}else {
				this.clock()
			}
		}
	},
	methods: {
		clock: function () {
			if (this.time > 0) setTimeout(this.clock, 500);
			this.time--
		}
	}
})
