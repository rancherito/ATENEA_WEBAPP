	Vue.component('image-drop', {
		template: `
		<div class="input-drop" ref="bg" :class="{'input-drop-content': this.state > 1}">
			<div class="input-drop-image">
				<div class="cover" ref="fill"></div>
				<img ref="imagePut" src="../public/images/dropfile.svg" @load="onLoadImage">
			</div>
			<canvas style="display: none" ref="imageCanvas" width="200"></canvas>
			<div class="input-drop-option">
				<label class="btn-floating">
					<i class="fal fa-camera"></i>
					<input type="file" accept="image/x-png,image/jpeg" @change="onUploadFile">
				</label>
				<div style="height: 5px"></div>
				<label class="input-drop-paste" :class="{'input-drop-waiting-paste': waitPaste}">
					<div class="dot"></div>
					<a class="btn-floating waves-effect waves"><i class="fal fa-clipboard"></i></a>
					<input class="browser-default" ref="lala" placeholder="Copie una imagen" @paste="onPaste">
				</label>

			</div>

		</div>
		`,
		data: function () {
			return {
				isUploadFromUrl: false,
				isLoadedImage: false,
				waitPaste: false,
				state: 0
			}
		},
		mounted: function () {
			this.$emit('get-image', this.$refs.imagePut)
			$(this.$refs.lala).focus(() => {
				this.waitPaste = true;
			})
			$(this.$refs.lala).focusout(() => {
				this.waitPaste = false;
			})
		},
		methods: {
			onLoadImage: function (e) {
				const img = this.$refs.imagePut
				const [w, h] = [img.naturalWidth,img.naturalHeight]
				let [fh, fw] = [0, 0]
				if (h > w) {
					fh = 200
					fw = (w * fh)/ h
				}
				else {
					fw = 200
					fh = (h * fw)/ w
				}
				const canvas = this.$refs.imageCanvas
				let ctx = this.$refs.imageCanvas.getContext('2d')
				canvas.height = fh
				ctx.drawImage(img, (200 - fw) / 2, 0,fw, fh);
				this.$emit('get-imageurl', this.$refs.imageCanvas.toDataURL())
				if (this.state) {
					$(this.$refs.fill).css('background-image', 'url("'+img.src+'")')
				}
				this.state++;

			},
			onPaste: function (e) {
				if (e.clipboardData.files[0]) this.loadFile(e.clipboardData.files[0])
			},
			onUploadFile: function (e) {
				if (e.target.files[0]) this.loadFile(e.target.files[0])
			},
			loadFile: function (file) {
				const reader = new FileReader();
				reader.addEventListener("load", e => {
					this.$refs.imagePut.src = reader.result
				}, false);
				reader.readAsDataURL(file);
			}
		}
	})
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
