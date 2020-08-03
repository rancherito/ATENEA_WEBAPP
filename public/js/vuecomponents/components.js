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
