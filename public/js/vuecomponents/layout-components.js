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
Vue.component('Soption',{
	template: `
		<div id="divider-option" class="f-c">
			<slot></slot>
		</div>
	`
})
