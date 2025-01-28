// Masks
export const cepMask = () => {
	const elements = [...document.querySelectorAll('[data-mask="cep"]')];
	elements.forEach(element => {
		element.addEventListener('input', () => {
			let value = element.value.replace(/\D/g, "");
			value = value.slice(0, 8);
			if (value.length > 5) {
				value = value.replace(/^(\d{5})(\d)/, "$1-$2");
			}
			element.value = value;
		});
	});
}

export const cpfMask = () => {
	const elements = [...document.querySelectorAll('[data-mask="cpf"]')];
	elements.forEach(element => {
		element.addEventListener('input', () => {
			let value = element.value.replace(/\D/g, "");
			value = value.slice(0, 11);
			if (value.length > 9) {
				value = value.replace(/^(\d{3})(\d{3})(\d{3})(\d)/, "$1.$2.$3-$4");
			}
			if (value.length > 6) {
				value = value.replace(/^(\d{3})(\d{3})(\d)/, "$1.$2.$3");
			}
			if (value.length > 3) {
				value = value.replace(/^(\d{3})(\d)/, "$1.$2");
			}
			element.value = value;
		});
	});
}

export const cnpjMask = () => {
	const elements = [...document.querySelectorAll('[data-mask="cnpj"]')];
	elements.forEach(element => {
		element.addEventListener('input', () => {
			let value = element.value.replace(/\D/g, "");
			value = value.slice(0, 14);
			if (value.length > 12) {
				value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d)/, "$1.$2.$3/$4-$5");
			}
			if (value.length > 8) {
				value = value.replace(/^(\d{2})(\d{3})(\d{3})(\d)/, "$1.$2.$3/$4");
			}
			if (value.length > 5) {
				value = value.replace(/^(\d{2})(\d{3})(\d)/, "$1.$2.$3");
			}
			if (value.length > 2) {
				value = value.replace(/^(\d{2})(\d)/, "$1.$2");
			}
			element.value = value;
		});
	});
}

export const moneyMask = () => {
	const elements = [...document.querySelectorAll('[data-mask="money"')];
	elements.forEach(element => {
		element.addEventListener('input', () => {
			let value = element.value.replace(/\D/g, "");
            value = value.replace(/^0+/, "") || '0';
            if (value.length < 3){
              value = value.padStart(3, '0');
            }
            value = value.replace(/(\d+)(\d{2})$/, '$1,$2');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            element.value = value;
		})
	})
}
