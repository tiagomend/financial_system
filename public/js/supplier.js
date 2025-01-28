import { cepMask, cpfMask, cnpjMask } from "./util.js";

const btnSubmit = document.getElementById('btn-submit');
const form = document.getElementById('main-form');

const elements = {
  labelForName: document.querySelector('[for="name_id"]'),
  labelForTradeName: document.querySelector('[for="trade_name_id"]'),
  inputTradeName: document.getElementById('trade_name_id'),
  selectPersonType: document.getElementById('person_type_id'),
  inputCpf: document.getElementById('cpf_id'),
  inputCnpj: document.getElementById('cnpj_id'),
  labelForCpf: document.querySelector('[for="cpf_id"]'),
  labelForCnpj: document.querySelector('[for="cnpj_id"]')
};

// Submit form on button click
btnSubmit.addEventListener('click', () => form.submit());

// Toggle visibility and labels based on person type
const updateFormForPersonType = (type) => {
  const isNaturalPerson = type === 'natural';

  elements.labelForName.textContent = isNaturalPerson ? 'Nome:' : 'Razão Social:';
  elements.labelForTradeName.style.display = isNaturalPerson ? 'none' : 'block';
  elements.inputTradeName.style.display = isNaturalPerson ? 'none' : 'block';
  elements.inputCnpj.style.display = isNaturalPerson ? 'none' : 'block';
  elements.labelForCnpj.style.display = isNaturalPerson ? 'none' : 'block';
  elements.inputCpf.style.display = isNaturalPerson ? 'block' : 'none';
  elements.labelForCpf.style.display = isNaturalPerson ? 'block' : 'none';
};

// Add event listener to selectPersonType
elements.selectPersonType.addEventListener('change', (e) => {
  updateFormForPersonType(e.target.value);
});

// Masks
cepMask();
cpfMask();
cnpjMask();
