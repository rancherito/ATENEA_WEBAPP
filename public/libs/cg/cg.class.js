var cg = {};
//utils
cg.regex = {
	nums: /^[0-9]+$/gi,
	words: /^[a-záéíóúüñ ]+$/gi,
	text: /^[a-záéíóúüñ. ]+$/gi,
	alphanums: /^[0-9a-záéíóúüñ. ]+$/gi,
	email: /(^[0-9]{0}$|^[a-z]+[a-z_\.\-0-9]+@[a-z]+\.[a-z]{2,5}$)/gi,
	range: /^[0-9]+[ ]{0,1}\-[ ]{0,1}[0-9]+$/gi
}
cg.error = {
	selector: 'cg.error: Selector no exist',
	typeOf: 'cg.error: typeof incorrect',
	argument: 'cg.error: arguments invalid'
};
cg.$ = function(selector) {
	if (selector) return $('<' + selector + '></' + selector + '>');
	return $('<div></div>');
};
cg.groupArrayJSON = function (array,groupby) {
	var arrRe = [];
	for(var i in array) {if (typeof arrRe[array[i][groupby]] === "undefined") arrRe[array[i][groupby]] = [];arrRe[array[i][groupby]].push(array[i]);}
	return arrRe;
}
cg.centerSelector = function(selector) {
	var w = selector.outerWidth();
	var h = selector.outerHeight();
	selector.css({
		'margin-top': ('-' + (h / 2) + 'px'),
		'margin-left': ('-' + (w / 2) + 'px')
	});
	selector.resize(function() {
		w = selector.outerWidth();
		h = selector.outerHeight();
		selector.css({
			'margin-top': '-' + (h / 2) + 'px',
			'margin-left': '-' + (w / 2) + 'px'
		});
	});
};
cg.centerSelectorWindow = function(selector) {
	var w = selector.outerWidth();
	var h = selector.outerHeight();
	selector.css({
		'margin-top': ('-' + (h / 2) + 'px'),
		'margin-left': ('-' + (w / 2) + 'px')
	});

	$(window).resize(function() {
		w = selector.outerWidth();
		h = selector.outerHeight();
		selector.css({
			'margin-top': '-' + (h / 2) + 'px',
			'margin-left': '-' + (w / 2) + 'px'
		});
	});
}
cg.fn = function(name, values) {
	var parameters = '(';
	if (values instanceof Array)
	for (var i = 0; i < values.length; i++) parameters += (i != 0 ? "," : "") + "$" + values[i];
	return name + parameters + ')';
}
cg.getFileExtension = function(filename) {
	return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
}
//class
cg.myDom = function() {
	this.container = cg.$('div');
	var style = 'myDom';
	this.style = function(newStyle) {
		if (typeof newStyle !== "undefined") {
			this.container.removeClass(style);
			style = newStyle;
			this.container.addClass(style);
			return this;
		}
		return style;
	}
	this.addClass = function(newClass) {
		this.container.addClass(newClass);
		return this;
	}
	this.callbackDom = function() {};
	this.dom = function(getcontainer) {
		if (typeof getcontainer === 'function') {
			return this;
		}
		return this.container;
	};
	this.appendTo = function(setAppend) {
		if (setAppend.length > 0) {
			this.container.appendTo(setAppend);
			this.callbackDom();
		}
		return this;
	};
	this.prependTo = function(setPrepend) {
		if (setPrepend.length > 0) {
			this.container.prependTo(setPrepend);
			this.callbackDom();
		}
		return this;
	};

	this.show = function(setShow) {
		if (typeof setShow === "boolean") {
			if (setShow) {
				this.container.show();
			} else {
				this.container.hide();
			}
		} else {
			this.container.show();
		}
		return this;
	}
	this.hide = function() {
		this.container.hide();
		return this;
	}
}
cg.bottomBox = function() {
	var THIS = this;
	cg.myDom.call(this);
	var box = cg.$("div").text("your text").css({
		overflow: "hidden"
	});
	var close = cg.$("button").addClass('ion-android-close bottomBox-close').css({
		float: "right"
	}).click(function(event) {
		THIS.container.animate({
			opacity: 0
		}, 500).detach();;
	});;
	this.container.addClass("bottomBox").css({
		position: "fixed",
		bottom: "0",
		"margin-bottom": "-100%"
	}).appendTo($("body")).animate({
		"margin-bottom": "0"
	}, 1000)
	.append(
		cg.$("div").append(close).css({
			width: "100%",
			overflow: "hidden"
		}), box
	);


	this.messageSee = function(newcontentMessage) {
		if (typeof newcontentMessage === 'string') {
			newcontentMessage = newcontentMessage.replace(/\n/g, '<br>');
		}
		box.empty().append(newcontentMessage);
		return this;
	};
}
cg.GaleryImages = function() {
	cg.myDom.call(this);
	var list_images = [];
	var list_imagesDom = [];
	var container = this.container.addClass('GaleryImages');
	var width = "100%";
	var countImg = 1;

	this.callbackDom = function() {
		container.css({
			width: width,
			overflow: "hidden",
			position: "relative"
		});
	}

	this.run = function() {
		var imgActivo = 0;
		setInterval(function() {
			list_imagesDom[imgActivo].animate({
				opacity: 0
			}, 500);
			imgActivo++;
			if (imgActivo > list_imagesDom.length - 1) {
				imgActivo = 0;
			}
			list_imagesDom[imgActivo].animate({
				opacity: 1
			}, 500);
		}, 4000);

		return this;
	}

	this.addImage = function(newImage) {
		if (typeof newImage !== "undefined") {
			for (var arg in arguments) {
				if (typeof arguments[arg] === "string") {
					var image = arguments[arg];
					if (list_images.indexOf(image) === -1) {
						if (cg.getFileExtension(image) !== "") {
							list_images.push(image);
							var procImage = cg.$("img").attr("src", image).css({
								display: "block",
								'width': '100%',
								position: "absolute",
								top: "0",
								left: "0"
							}).addClass('galery_img-' + countImg);
							countImg++;
							list_imagesDom.push(procImage);
							if (countImg === 2) {
								this.container.append(cg.$("img").attr("src", image).css({
									display: "block",
									'width': '100%',
									opacity: 0
								}));
							} else {
								procImage.css({
									opacity: 0
								});
							}
							this.container.append(procImage);
						}
					}
				}
			}
			return this;
		}
		return list_images;
	};
}
cg.vview = function(val, view) {
	this.val = val;
	this.view = view;
}
cg.MessageBox = function(setTypeBox) {
	var container = cg.$('div');
	var btnAceptar = cg.$('button').addClass('ok');
	var btnCerrar = cg.$('button').addClass('close');
	var pnlBotones = cg.$('div');
	var _container = cg.$('div').addClass('MessageBox');
	var contentMessage = cg.$('div');

	this.constructor = function() {
		var THIS = this;

		btnAceptar
		.css({
			height: '30px',
			width: '100px',
			float: 'right'
		})
		.hide()
		.click(function(event) {
			THIS.close();
		})
		.text('Aceptar');

		btnCerrar
		.css({
			height: '30px',
			width: '100px',
			float: 'right'
		})
		.text('Cerrar')
		.click(function(event) {
			THIS.close();
		});

		pnlBotones
		.css({
			width: '100%',
			height: '30px',
			padding: '15px 0 0'
		})
		.append(btnCerrar)
		.append(btnAceptar);

		container
		.css({
			background: 'white',
			position: 'absolute',
			left: '50%',
			top: '50%'
		})
		.css({
			width: '320px',
			'box-sizing': 'border-box',
			padding: '15px'
		})
		.append(contentMessage)
		.append(pnlBotones);

		cg.centerSelector(container);
		_container
		.css({
			background: 'rgba(0, 0, 0, 0.5)',
			position: 'fixed',
			top: 0,
			left: 0,
			width: '100%',
			height: '100%',
			'z-index': 9999
		})
		.append(container);

		if (setTypeBox) {
			this.typeBox(setTypeBox);
		}
	};
	this.typeBox = function(editarTipo) {
		switch (editarTipo) {
			case 'COMMON':
			btnAceptar.hide();
			btnCerrar.show();
			break;
			case 'CONFIRMATION':
			btnAceptar.show();
			btnCerrar.show();
			break;
			case 'ONLY_CONFIRMATION':
			btnAceptar.show();
			btnCerrar.hide();
			break;
			case 'NO_BUTTONS':
			pnlBotones.hide();
			break;
		}
		return this;
	};
	this.dom = function(getcontainer) {
		if (typeof getcontainer === 'function') {
			getcontainer(container);
			return this;
		}
		return container;

	};
	this.appendTo = function(selector) {
		if (selector) {
			container.appendTo(selector);
		} else {
			console.log(cg.error.selector);
		}
		return this;
	};
	this.show = function() {
		_container.css('opacity', '0').appendTo('body').animate({
			'opacity': 1
		}, 250);
		return this;
	};
	this.close = function(setTime) {
		var time = typeof setTime === 'number' ? setTime : 250;

		_container.animate({
			'opacity': 0
		}, time, function() {
			_container.detach();
		});
		return this;
	};
	this.messageSee = function(newcontentMessage) {
		if (typeof newcontentMessage === 'string') {
			newcontentMessage = newcontentMessage.replace(/\n/g, '<br>');
		}
		contentMessage.empty().append(newcontentMessage);
		return this;
	};
	this.accept = function(callback) {
		btnAceptar.click(function(event) {
			if (callback) {
				callback();
			}
		});
		return this;
	};
	this.constructor();
};
cg.DataTable = function(setSource) {
	var data = {};
	var rowsData = 0;
	this.addColumn = function(nameColumn) {
		data[nameColumn] = null;
		return this;
	};

	this.partInGroups = function(column) {
		var temp = [];
		var st1 = "",
		st2 = "";

		if (!this.isEmpty("bool")) {
			var invert = this.invert();
			var ii = 0;
			for (var i in data) {
				if (column === i) {
					break;
				}
				ii++;
			}
			var tt = {};
			var ata = false;
			for (var i in invert) {
				st1 = invert[i][ii];
				if (st1 !== st2) {
					if (ata) {
						temp.push($.extend({}, tt));
					}
					for (var gg in data) {
						tt[gg] = []
					}
					ata = true;
				}
				var aaa = 0;
				for (var a in tt) {
					tt[a].push(invert[i][aaa]);
					aaa++;
				}
				st2 = st1;
			}
			temp.push($.extend({}, tt));
		}
		return temp;
	}
	this.invert = function() {
		var newData = [];
		var a = true;
		for (var i in data) {
			for (var e in data[i]) {
				if (a) {
					newData.push([]);
				}
				newData[e].push(data[i][e]);
			}
			a = false;
		}
		return newData;
	}
	this.source = function(newData) {
		var maxDimension = 0;
		if (typeof newData !== "undefined") {
			if (typeof newData === 'object') {
				for (var column in newData) {
					var size = newData[column].length;
					maxDimension = maxDimension < size ? size : maxDimension;
				}
				rowsData = maxDimension;
				for (var variable in newData) {
					for (var i = newData[variable].length; i < maxDimension; i++) {
						newData[variable].push(null);
					}
				}

				data = newData;
				return this;
			}
		}
		return data;
	};
	this.isEmpty = function(bool) {
		var empty = $.isEmptyObject(data);

		if (typeof bool === 'string') {
			if (bool === 'bool') return empty;
		}
		return empty ? 'YES' : 'NO_EMPTY';
	};
	this.newRows = function() {
		for (var variable in arguments) {
			var args = arguments[variable];
			if (args instanceof Array) {
				var newRow = args;
				var i = 0,
				arSize = args.length;
				if (arSize > 0) {
					for (var column in data) {
						if (arSize > i) {
							if (typeof args[i] === 'string') data[column].push(args[i]);
							else data[column].push(null);
						} else data[column].push(null);
						i++;
					}
					rowsData++;
				}
			} else if (args instanceof Object) {
				for (var column in data) {
					var newArg = typeof args[column] === 'string' ? args[column] : null;
					data[column].push(newArg);
				}
			} else {
				console.log(cg.error.argument + '(' + args + ')');
			}
		}
		return this;
	};
	this.constructor = function() {
		this.source(setSource);
	};
	this.constructor();
};
cg.Input = function(type) {
	var isInDom = false;
	var inputType = 'textBox';
	var listInputs = {
		'textBox': cg.$('input').attr('type', 'text').show().addClass('cg-input'),
		'label': cg.$('option').show().addClass('cg-input'),
		'select': cg.$('select').show().addClass('cg-input')
	};

	this.getListInputs = function() {
		return listInputs;
	}



	if (typeof type !== "undefined") {
		this.input(type);
	}
	this.callbackDom = function() {};
	this.input = function(setInput) {
		if (typeof setInput !== 'undefined') {
			if (typeof setInput === 'string' && listInputs[setInput] !== 'undefined' && inputType !== setInput) {
				if (listInputs[inputType].parent().length) listInputs[inputType].after(listInputs[setInput]).detach();
				inputType = setInput;
			}
			return this;
		}
		return listInputs[inputType];
	};
	this.dom = function(setInput) {
		return this.input(setInput);
	}
	this.appendTo = function(setAppend) {
		if (setAppend.length > 0) {
			this.input().appendTo(setAppend);
			isInDom = true;
		}
		return this;
	};
	this.prependTo = function(setPrepend) {
		if (setPrepend.length > 0) {
			this.input().prependTo(setPrepend);
			isInDom = true;
		}
		return this;
	};
	this.placeholder = function(newPlaceholder) {
		if (typeof newPlaceholder === 'string') {
			listInputs.textBox.prop('placeholder', newPlaceholder);
		}
		return this;
	};
	this.val = function(setVal) {
		if (typeof setVal !== 'undefined') {
			if (typeof setVal !== 'object') {
				this.input().val(setVal);
			}
			return this;
		}
		return this.input().val();
	};
	this.text = function(setText) {
		if (typeof setText !== 'undefined') {
			if (typeof setText !== 'object') {
				this.input().text(setText);
			}
			return this;
		}
		return this.input().text();
	}
	this.addClass = function(addClass) {
		if (typeof addClass !== 'undefined') {
			for (var variable in listInputs) {
				listInputs[variable].addClass(addClass);
			}
		}
		return this;
	};

	var style = "";
	this.style = function(newStyle) {
		if (typeof newStyle !== "undefined") {
			this.input().removeClass(style);
			for (var i in listInputs) {
				listInputs[i].removeClass(style);
			}
			style = newStyle;
			this.input().addClass(style);
			for (var i in listInputs) {
				listInputs[i].addClass(style);
			}
			return this;
		}
		return style;
	}
}
cg.Option = function(val, view) {
	return cg.$("option").text(view).val(val);
}
cg.InputX = function(setInput) {
	cg.myDom.call(this);

	var typeInput = "textbox";
	var styleDefault = {
		overflow: "hidden",
		display: 'block'
	};
	var iSel = cg.$("button").addClass('ion-arrow-down-b ImputX-arrow').css({
		background: "transparent",
		cursor: "pointer",
		"font-family": "Tw Cen MT",
		border: 0,
		outline: 0,
		"border-style": "solid",
		position: "absolute",
		height: "100%",
		top: 0,
		right: 0,
		width: 30,
		"font-size": "16px"
	});
	var list = cg.$("div")
	.addClass('ImputX-list').hide()
	.css({
		"max-height": "150px",
		"z-index": 999,
		background: "white",
		"border-radius": "1px",
		border: "1px gray solid",
		top: "100%",
		padding: "3px",
		width: "100%",
		position: "absolute"
	})
	.append(cg.Option("-1", "Elige una opción").css({
		cursor: "default"
	}));

	var mlsave = cg.$("button").addClass('ion-android-done ImputX-close').css({
		padding: "0px 3px"
	});
	var miSel = cg.$("button").addClass('ion-arrow-down-b ImputX-arrow').css({
		background: "transparent",
		cursor: "pointer",
		"font-family": "Tw Cen MT",
		border: 0,
		outline: 0,
		"border-style": "solid",
		position: "absolute",
		height: "100%",
		top: 0,
		right: 0,
		width: 30,
		"font-size": "16px"
	});
	var multiList = cg.$("div").addClass('ImputX-list').hide().css({
		"max-height": "150px",
		"z-index": 999,
		"border-radius": "1px",
		border: "1px gray solid",
		top: "100%",
		padding: "3px",
		width: "100%",
		position: "absolute",
		background: "white"
	}).append(
		cg.$("div").addClass('ImputX-close-panel').append(mlsave),
		cg.$("div").addClass('ImputX-list-panel').css({
			"overflow": "hidden"
		})
	);

	mlsave.click(function(event) {
		multiList.hide();
	});
	var check = cg.$("input").attr('type', 'checkbox').addClass('slide').css({
		cursor: "pointer",
		width: "100%",
		position: "absolute",
		"text-align": "center",
		left: "0",
		height: "100%",
		"z-index": 5,
		opacity: 0,
		'pointer-events': 'initial'
	});
	var listInputs = {
		textbox: cg.$("input").attr('type', 'text').addClass('ImputX-input').css(styleDefault),
		label: cg.$("button").addClass('ImputX-input').css(styleDefault),
		select: cg.$("button").addClass('ImputX-input').css(styleDefault).css({
			cursor: "pointer"
		}).text('Elije una opción'),
		cselect: cg.$("select").addClass('ImputX-input').css(styleDefault).css({
			cursor: "pointer"
		}).append(cg.Option("-1", "Elije una opción").prop('disabled', true)).val("-1"),
		multiselect: cg.$("button").addClass('ImputX-input').css(styleDefault).text("Elija una o más opciones").css({
			cursor: "pointer"
		}),
		checkbox: cg.$("div").addClass('InputX-check').css({
			cursor: "pointer",
			overflow: "hidden",
			position: "relative"
		}).append(
			cg.$("a").css({
				width: "50%",
				float: "left",
				height: "100%"
			}).addClass('ion-ios-close-empty'),
			cg.$("a").css({
				width: "50%",
				float: "left",
				height: "100%"
			}).addClass('ion-ios-checkmark-empty'),
			check,
			cg.$("div").addClass('slidev').css({
				width: "50%",
				position: "absolute",
				"text-align": "center",
				left: "0",
				height: "100%",
				"z-index": 1
			})
		)
	};

	check.click(function(event) {
		var checkb = check.prop("checked");
		listInputs["checkbox"].find('.slidev').css({
			left: (checkb ? "50%" : "0%")
		});

	});

	iSel.click(function(event) {
		list.toggle();
	}).focusout(function(event) {
		if (!hoverOptions) {
			list.hide();
		}
	});
	listInputs["select"].click(function(event) {
		list.toggle();
	}).focusout(function(event) {
		if (!hoverOptions) {
			list.hide();
		}
	});

	miSel.click(function(event) {
		multiList.toggle();
	});
	listInputs["multiselect"].click(function(event) {
		multiList.toggle();
	});

	var hoverOptions = false;



	this.container
	.addClass('ImputX').addClass(typeInput)
	.css({
		position: "relative"
	})
	.append(listInputs["textbox"]);

	this.getAllInputs = function() {
		return [listInputs["textbox"],
		listInputs["label"],
		listInputs["select"],
		listInputs["cselect"],
		listInputs["multiselect"],
		check
	];
}

this.checked = function(setchecked) {
	if (typeof setchecked !== "undefined") {
		if (typeof setchecked === "boolean") {
			check.prop("checked", setchecked);
			listInputs["checkbox"].find('.slidev').css({
				left: (setchecked ? "50%" : "0%")
			});
		}
		return this;
	}
	return (check.prop("checked") ? true : false);
}
this.placeholder = function(setPlaceholder) {
	if (typeof setPlaceholder !== "undefined") {
		listInputs["textbox"].attr('placeholder', setPlaceholder);
		return this;
	}
	return listInputs["textbox"].attr('placeholder');
}
this.disabled = function(setDisabled) {
	for (var i in listInputs) {
		let item = listInputs[i]
		item.prop('disabled', setDisabled)
	}
	return this;
}
this.name = function(set) {
	if (typeof set !== "undefined") {
		for (var i in this.getAllInputs()) {
			this.getAllInputs()[i].attr("name", set);
		}
		return this;
	}
	return this.input();
}
this.input = function(setInput) {
	if (typeof setInput !== "undefined") {
		if (typeof listInputs[setInput] !== "undefined") {
			if (setInput !== typeInput) {
				listInputs[typeInput].detach();
				this.container.removeClass(typeInput);
				this.container.append(listInputs[setInput]);
				typeInput = setInput;
				this.container.addClass(typeInput);

				if (typeInput === "select") {
					this.container.append(iSel, list);
				} else {
					iSel.detach();
					list.detach();
				}
				if (typeInput === "multiselect") {
					this.container.append(miSel, multiList);
				} else {
					miSel.detach();
					multiList.detach();
				}
			}
		}
		return this;
	}
	if (typeInput === "checkbox") return check;
	return listInputs[typeInput];
}
this.change = function(fn) {
	if (typeof fn === "function") {
		if (typeInput === "checkbox") {
			check.change(function(event) {
				fn(event);
			});
		} else {
			listInputs[typeInput].change(function(event) {
				fn(event);
			});
		}
	}
	return this;
}

this.val = function(setVal) {
	if (typeof setVal !== "undefined") {
		if (typeInput === "select") {
			if (list.children().length > 0) {
				if (list.find('option[value ="' + setVal + '"]').length > 0) {
					listInputs["select"].val(setVal).text(list.find('option[value ="' + setVal + '"]').text());
				} else {
					listInputs["select"].val("").text("");
				}
			}
		} else if (typeInput === "multiselect") {
			for (var i in optionList) {
				optionList[i].active = false;
				optionList[i].option.css("background", "transparent");
			}

			for (var val in setVal) {
				for (var i in optionList) {
					if (setVal[val] + "" === optionList[i].val) {
						optionList[i].active = true;
						optionList[i].option.css("background", colorOpAct);
					}
				}
			}
			var e = 0;
			var testmsel = "";
			for (var i in optionList) {
				if (e > 1) {
					break;
				}
				if (optionList[i].active) {
					testmsel = optionList[i].option.text();
					e++;
				}
			}
			var text = ['Elija una o más opciones', testmsel, "varias seleciones"];
			listInputs["multiselect"].text(text[e]);
		} else {
			listInputs[typeInput].val(setVal);
		}
		return this;
	}
	if (typeInput === "multiselect") {
		var optionVal = [];
		for (var i in optionList) {
			if (optionList[i].active) {
				optionVal.push(optionList[i].option.val());
			}
		}
		return optionVal;
	}
	return listInputs[typeInput].val();
}
this.text = function(setText) {
	if (typeof setText !== "undefined") {
		if (typeInput !== "select" && typeInput !== "multiselect") {
			listInputs[typeInput].text(setText);
		}
		return this;
	}
	if (typeInput === "cselect") {
		return listInputs[typeInput].find('option:selected').text();
	}
	return listInputs[typeInput].text();
}
var colors = ["red", "blue"];
var activeOption = [];
var optionList = [];
var soptionList = [];
this.typeInput = function() {
	return typeInput;
}
this.mOptionList = function() {
	return optionList;
}
this.sOptionList = function() {
	return soptionList;
}
this.addItem = function(newItem) {
	if (typeof newItem !== "undefined") {
		for (var arg in arguments) {
			if (typeInput === "select") {
				var myoption = {
					option: arguments[arg],
					val: arguments[arg].val()
				};
				soptionList.push(myoption);
				list.append(
					myoption.option
					.css({
						"white-space": "nowrap",
						"overflow": "hidden",
						cursor: "pointer"
					})
					.hover(function() {
						$(this).css({
							background: "#ddd"
						});
						hoverOptions = true
					}, function() {
						$(this).css({
							background: "transparent"
						});
						hoverOptions = false;
					})
					.click(function(event) {
						listInputs["select"].attr("value", $(this).val()).text($(this).text());
						list.hide();
					})
				);
			}
			if (typeInput === "multiselect") {
				var myoption = {
					option: arguments[arg],
					active: false,
					val: arguments[arg].val()
				};
				optionList.push(myoption);
				optionSettings(myoption, listInputs);
				myoption.option
				.css({
					"white-space": "nowrap",
					"overflow": "hidden"
				})
				.click(function(event) {
					var e = 0;
					var testmsel = "";
					for (var i in optionList) {
						if (e > 1) {
							break;
						}
						if (optionList[i].active) {
							testmsel = optionList[i].option.text();
							e++;
						}
					}
					var text = ['Elija una o más opciones', testmsel, "varias seleciones"];
					listInputs["multiselect"].text(text[e]);
				});
				multiList.find("div.ImputX-list-panel").append(myoption.option);
			}
			if (typeInput === "cselect") {
				listInputs["cselect"].append(arguments[arg]);
			}
		}
		if (typeInput === "select") {
			if (list.children().length > 0) {
				listInputs["select"].attr("value", $(list.children()[0]).val()).text($(list.children()[0]).text());
			}
		}
	}
	return this;
}
this.deleteAllItem = function() {
	list.empty();
	listInputs["cselect"].empty();
	return this;
}
this.input(setInput);
var colorOpAct = "#ddd";

function optionSettings(optionList, listInputs) {
	optionList.option.css({
		float: "left",
		margin: "2px",
		padding: "3px",
		cursor: "pointer"
	})
	.hover(function() {
		$(this).css({
			background: colorOpAct
		});
	}, function() {
		if (optionList.active) {
			$(this).css({
				background: colorOpAct
			});
		} else {
			$(this).css({
				background: "transparent"
			});
		}
	})
	.click(function(event) {
		optionList.active = !optionList.active;
	})
}
}
cg.InputForm = function() {
	cg.myDom.call(this);
	var activeNotify = true;
	var input = new cg.InputX();
	var boxLeyenda = cg.$("div").addClass("InputForm-boxTitle");
	var textLeyenda = cg.$("span").addClass('InputForm-title').appendTo(boxLeyenda);
	var textAlert = cg.$("span").addClass('InputForm-alert').hide().css({
		cursor: "pointer"
	}).text('error en el campo');
	var leyenda = 'some text';
	var textAlerts = {
		novoid: "Campo vacio",
		novalues: "Opción no valida",
		regex: "Corregir formato",
		dimension: "Dimensión incorrecta",
		range: "Rango exedido",
		checked: "Campo sin aceptar"
	};
	var validations = {
		novalues: null,
		novoid: false,
		regex: null,
		dimension: null,
		range: null,
		checked:false
	};
	textAlert.click(function(event) {
		textAlert.hide(200);
	});

	this.checked = function(setchecked) {
		if (typeof setchecked !== "undefined") {
			input.checked(setchecked);
			return this;
		}
		return input.checked();
	}


	this.activeNotify = function(setNotify) {
		if (typeof setNotify === "boolean") {
			activeNotify = setNotify;
		}
		return this;
	}

	this.disabled = function(setDisabled) {
		input.disabled(setDisabled);
		return this;
	}
	this.validation = function(setValitations) {
		for (var i in setValitations) {
			if (typeof validations[i] !== "undefined") {
				validations[i] = setValitations[i];
			}
		}
		return this;
	}
	this.isValid = function() {
		var valid = true;
		if (activeNotify) {
			if (valid) {
				if (input.typeInput() === "checkbox") {
					if (validations["checked"]) {
						textAlert.text(textAlerts["checked"]);
						valid = input.checked();
					}
				}
			}
			if (valid) {
				if (input.typeInput() === "select" || input.typeInput() === "cselect") {
					if (validations["novalues"] !== null) {
						textAlert.text(textAlerts["novalues"]);
						valid = validations["novalues"].indexOf(input.val()) === -1;
					}
				}
			}
			if (valid) {
				if (input.typeInput() === "multiselect") {
					if (validations["novoid"]) {
						textAlert.text(textAlerts["novoid"]);
						valid = input.val().length > 0;
					}
				}
				if (input.typeInput() === "textbox") {
					if (validations["novoid"]) {
						textAlert.text(textAlerts["novoid"]);
						valid = input.val().length > 0;
					}
				}
			}
			if (valid) {
				if (input.typeInput() === "textbox") {
					if (validations["regex"] !== null) {
						textAlert.text(textAlerts["regex"]);
						if (input.val().length > 0) {
							var arr = input.val().match(validations["regex"]);
							valid = arr !== null;
						}

					}
				}
			}
			if (valid) {
				if (input.typeInput() === "textbox") {
					if (validations["dimension"] !== null) {
						textAlert.text(textAlerts["dimension"]);



						var valDim = false;
						var dimvalor = input.val().length;
						var dimension = validations["dimension"];
						for (var i in dimension) {
							var value = dimension[i];
							if (typeof value === "number") {
								valDim |= dimvalor === value;
							}
							if (typeof value === "string") {
								if (!isNaN(value)) {
									valDim |= dimvalor === parseInt($value);
								} else {
									if (value.match(cg.regex.range) !== null) {
										var arrg = value.split('-');
										arrg[0] = parseInt(arrg[0]);
										arrg[1] = parseInt(arrg[1]);
										valDim |= dimvalor >= arrg[0] && dimvalor <= arrg[1];
									}
								}
							}
						}
						valid = valDim;
					}
				}
			}
			if (valid) {
				textAlert.hide(200);
			} else {
				textAlert.show(200);
			}
		}
		return valid;
	}
	this.container
	.append(
		cg.$("div").css('position', 'relative').append(
			boxLeyenda,
			input.placeholder("your text").dom()
		),
		textAlert
	)
	.addClass('InputForm')
	.click(function(event) {
		textAlert.hide(200);
	});
	this.input = function(setInput) {
		if (typeof setInput !== "undefined") {
			input.input(setInput);
			return this;
		}
		return input.input();
	};

	this.name = function(set) {
		if (typeof set !== "undefined") {
			input.name(set);
			return this;
		}
		return input.name();
	};
	this.placeholder = function(setPlaceholder) {
		input.placeholder(setPlaceholder);
		return this;
	}
	this.text = function(setText) {
		if (typeof setText === "undefined") {
			return input.text();
		}
		input.text(setText);
		return this;
	};
	this.val = function(setVal) {
		if (typeof setVal === "undefined") {
			return input.val();
		}
		input.val(setVal);
		return this;
	}
	this.leyenda = function(setLeyenda) {
		if (typeof setLeyenda !== "undefined") {
			if (typeof setLeyenda === "string") {
				leyenda = setLeyenda;
				textLeyenda.text(leyenda);
				return this;
			}
		}
		return leyenda;
	}
	this.leyenda(leyenda);

	this.addItem = function(newitem) {
		for (var arg in arguments) {
			input.addItem(arguments[arg]);
		}
		return this;
	}

	this.deleteAllItem = function() {
		input.deleteAllItem();
		return this;
	}

	this.addItemDB = function(url, prodec, opciones, callback) {

		input.deleteAllItem();
		$.post(url, prodec, function(DATA) {
			input.addItem(cg.Option("-1", "Elije una opción").prop("disabled", true)).val("-1");
			input.addItem(cg.listOption(opciones, DATA));
			if (typeof callback === "function") {
				callback();
			}
		},'json');
		return this;
	}
}

cg.listOption = function(rest, oJsonData) {
	var List = '';

	for (var i = 0; i < oJsonData.length; i++) {
		List += '<option value="' + oJsonData[i][rest['valor']] + '">' + oJsonData[i][rest['nombre']] + '</option>';
	}
	return $(List);
}
cg.MultiPanelView = function() {
	cg.myDom.call(this);
	this.container = cg.$('div').addClass('cg-multipanel');
	var pnl_access = cg.$('div').addClass('cg-multipanel-access').appendTo(this.container);
	var pnl_view = cg.$('div').addClass('cg-multipanel-view').appendTo(this.container);
	var list_access = [];
	var list_views = [];

	this.access = function() {
		return list_access;
	}
	this.views = function() {
		return list_views;
	}

	function addEventClick(access, panel) {
		access.click(function(event) {
			for (var views in list_views) {
				list_views[views].detach();
			}
			panel.appendTo(pnl_view);
		});
	}

	this.addPanel = function(custom) {
		if (typeof custom !== 'undefined' && typeof custom === 'object') {
			list_access.push(cg.$('button').text(custom.text !== 'undefined' ? custom.text : 'panel'));
			pnl_access.append(list_access[list_access.length - 1])
			list_views.push(custom.panel !== 'undefined' ? custom.panel : cg.$('div'));
		}
		for (var views in list_views) {
			list_views[views].detach();
		}
		list_views[0].appendTo(pnl_view);
		for (var access in list_access) {
			list_access[access].unbind('click');
			addEventClick(list_access[access], list_views[access]);
		}
		return this;
	}
}
cg.QuestionsData = function() {
	this.name = "";
	this.question = {
		view: [],
		val: []
	};
	this.type = "";
}
cg.CircleNumber = function() {
	cg.myDom.call(this);
	var cnumber = cg.$("button");
	var cleyenda = cg.$("div").addClass('CircleNumber-leyenda');
	var leyenda = "your text";
	var number = 0;

	this.container
	.addClass('CircleNumber')
	.append(cg.$("div").addClass('CircleNumber-cnumber').append(cnumber), cleyenda);
	this.number = function(setNumber) {
		if (typeof setNumber !== "undefined") {
			number = setNumber;
			cnumber.text(number)
			return this;
		}
		return number;
	}
	this.number(number);

	this.leyenda = function(setLeyenda) {
		if (typeof setLeyenda !== "undefined") {
			leyenda = setLeyenda;
			cleyenda.text(leyenda);
			return this;
		}
		return leyenda;
	}
	this.leyenda(leyenda);
}
cg.FormMagic = function FormMagic() {
	cg.myDom.call(this);
	this.container.addClass('FormMagic');
	this.question = {};
	var datatable = new cg.DataTable();
	var groups = {
		val: [],
		view: []
	};
	this.datatable = function(newDatatable) {
		if (typeof newDatatable !== "undefined") {
			if (newDatatable instanceof cg.DataTable) {
				datatable = newDatatable;
			}
			return this;
		}
		return datatable;
	}
	this.listFormInput = {};
	this.makeForm = function(positionForm) {
		if (!datatable.isEmpty("bool")) {
			var source = datatable.source();
			var columsGroup = {
				groups: [],
				quest: [],
				type: [],
				alter: [],
				value: []
			};
			for (var i in columsGroup) {
				columsGroup[i] = source[positionForm[i]];
			}
			var newData = [];
			var a = true;
			for (var i in columsGroup) {
				for (var e in columsGroup[i]) {
					if (a) {
						newData.push([]);
					}
					newData[e].push(columsGroup[i][e]);
				}
				a = false;
			}
			var usedQ = [];
			for (var i in newData) {
				if (typeof this.question[newData[i][0]] === "undefined") {
					this.question[newData[i][0]] = [];
				}
				if (usedQ.indexOf(newData[i][1]) === -1) {
					var qq = new cg.QuestionsData();
					qq.name = newData[i][1];
					qq.type = newData[i][2];
					usedQ.push(newData[i][1]);
					this.question[newData[i][0]].push(qq);
				}
				for (var e = 0; e < this.question[newData[i][0]].length; e++) {
					if (this.question[newData[i][0]][e].name === newData[i][1]) {
						this.question[newData[i][0]][e].question['view'].push(newData[i][3]);
						this.question[newData[i][0]][e].question['val'].push(newData[i][4]);
					}
				}
			}

			for (var i in this.question) {
				var body = cg.$("div").addClass('FormMagic-body');
				this.container.append(
					cg.$("div").addClass('FormMagic-group').append(cg.$("div").text(i).addClass('FormMagic-title'), body)
				);
				this.listFormInput[i] = [];
				for (var e in this.question[i]) {
					var inp = new cg.InputForm();
					this.listFormInput[i].push(inp);
					inp.leyenda(this.question[i][e].name).input(this.question[i][e].type);
					var viewData = this.question[i][e].question.view;
					for (var f in viewData) {
						inp.addItem(cg.Option(f, viewData[f]))
					}
					body.append(inp.dom());
				}
				body.append(cg.$("div").css('clear', 'both'));
			}

		}
		return this;
	}
	this.makeFromRequest = function(positionForm) {

		this.question = {};
		this.listFormInput = {};
		this.container.empty();

		if (!datatable.isEmpty("bool")) {
			var source = datatable.source();
			var columsGroup = {
				groups: [],
				quest: [],
				request: []
			};
			for (var i in columsGroup) {
				columsGroup[i] = source[positionForm[i]];
			}
			var newData = [];
			var a = true;
			for (var i in columsGroup) {
				for (var e in columsGroup[i]) {
					if (a) {
						newData.push([]);
					}
					newData[e].push(columsGroup[i][e]);
				}
				a = false;
			}
			var usedQ = [];
			for (var i in newData) {
				if (typeof this.question[newData[i][0]] === "undefined") {
					this.question[newData[i][0]] = [];
				}
				if (usedQ.indexOf(newData[i][1]) === -1) {
					var qq = new cg.QuestionsData();
					qq.name = newData[i][1];
					qq.type = newData[i][2];
					usedQ.push(newData[i][1]);
					this.question[newData[i][0]].push(qq);
				}
				for (var e = 0; e < this.question[newData[i][0]].length; e++) {
					if (this.question[newData[i][0]][e].name === newData[i][1]) {
						this.question[newData[i][0]][e].question['view'].push(newData[i][2]);
					}
				}
			}

			for (var i in this.question) {
				var body = cg.$("div").addClass('FormMagic-body');
				this.container.append(
					cg.$("div").addClass('FormMagic-group').append(cg.$("div").text(i).addClass('FormMagic-title'), body)
				);
				this.listFormInput[i] = [];
				for (var e in this.question[i]) {
					var inp = new cg.InputForm();
					this.listFormInput[i].push(inp);
					inp.leyenda(this.question[i][e].name).input("label");
					var viewData = this.question[i][e].question.view;
					var text = "";
					for (var f in viewData) {
						text += (f === "0" ? "" : ", ") + viewData[f];
					}
					inp.text(text);
					body.append(inp.dom());
				}
				body.append(cg.$("div").css('clear', 'both'));
			}

		}
		return this;
	}
}


cg.in_range = function(x, a, b) {
	var mayor = a > b ? a : b;
	var menor = a < b ? a : b;
	return x <= mayor && x >= menor;
}

//delegates
cg.dataTable = function(source) {
	return new cg.DataTable(source);
};
cg.messageBox = function(param) {
	return new cg.MessageBox(param);
};
cg.input = function(type) {
	return new cg.Input(type);
};
cg.multiPanelView = function() {
	return new cg.MultiPanelView();
};
cg.obj = {};
cg.readyObj = function() {
	$('cgObjet').each(function(index) {
		var type = $(this).attr('type');
		var name = $(this).attr('name');
		var iclass = $(this).attr('style');
		if (typeof cg[type] !== 'undefined') {
			if (typeof cg.obj[type] === 'undefined') {
				cg.obj[type] = {};
			}
			if (typeof cg.obj[type][name] === 'undefined') {
				eval('cg.obj.' + type + '.' + name + ' = new cg.' + type + '();');
				$(this).after(cg.obj[type][name].addClass('cgObjet').dom().attr({
					'cggname': name,
					'cggtype': type
				})).remove();
				cg.obj[type][name].style(iclass);
				cg.obj[type][name].callbackDom();
				if (typeof cg[name] === 'undefined') {
					cg[name] = cg.obj[type][name];
				}
			}
		}
	});
};
