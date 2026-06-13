$(document).ready(function () {

    // Máscaras
    $('#cpf').mask('000.000.000-00');
    $('#cnpj').mask('00.000.000/0000-00');

    // Validação - Comprador
    $('#formCadastroComprador').validate({
        rules: {
            nome: { required: true, minlength: 3 },
            cpf: { required: true, minlength: 14, maxlength: 14 },
            email: { required: true, email: true },
            idade: { required: true, min: 1 }
        },
        messages: {
            nome: {
                required: 'O nome é obrigatório.',
                minlength: 'O nome deve ter pelo menos 3 caracteres.'
            },
            cpf: {
                required: 'O CPF é obrigatório.',
                minlength: 'Formato de CPF incompleto.'
            },
            email: {
                required: 'O email é obrigatório.',
                email: 'Informe um email válido.'
            },
            idade: {
                required: 'A idade é obrigatória.',
                min: 'A idade deve ser maior que zero.'
            }
        }
    });

    // Validação - Divulgador
    $('#formCadastroDivulgador').validate({
        rules: {
            nome: { required: true, minlength: 3 },
            cnpj: { required: true, minlength: 18, maxlength: 18 },
            email: { required: true, email: true }
        },
        messages: {
            nome: {
                required: 'O nome é obrigatório.',
                minlength: 'O nome deve ter pelo menos 3 caracteres.'
            },
            cnpj: {
                required: 'O CNPJ é obrigatório.',
                minlength: 'Formato de CNPJ incompleto.'
            },
            email: {
                required: 'O email é obrigatório.',
                email: 'Informe um email válido.'
            }
        }
    });

    // Validação - Evento
    $('#formCadastroEvento').validate({
        rules: {
            nome: { required: true, minlength: 3 },
            descricao: { required: true },
            cidade: { required: true },
            local: { required: true },
            data_evento: { required: true }
        },
        messages: {
            nome: {
                required: 'O nome é obrigatório.',
                minlength: 'O nome deve ter pelo menos 3 caracteres.'
            },
            descricao: { required: 'A descrição é obrigatória.' },
            cidade: { required: 'A cidade é obrigatória.' },
            local: { required: 'O local é obrigatório.' },
            data_evento: { required: 'A data é obrigatória.' }
        }
    });

    // Validação - Ingresso
    $('#formCadastroIngresso').validate({
        rules: {
            evento_id: { required: true },
            preco: { required: true, min: 0 },
            quantidade: { required: true, min: 1 }
        },
        messages: {
            evento_id: { required: 'Selecione um evento.' },
            preco: {
                required: 'O preço é obrigatório.',
                min: 'O preço não pode ser negativo.'
            },
            quantidade: {
                required: 'A quantidade é obrigatória.',
                min: 'A quantidade deve ser pelo menos 1.'
            }
        }
    });

    // Validação - Pedido
    $('#formCadastroPedido').validate({
        rules: {
            comprador_id: { required: true },
            evento_id: { required: true },
            data: { required: true },
            quantidade: { required: true, min: 1 },
            total: { required: true, min: 0 }
        },
        messages: {
            comprador_id: { required: 'Selecione um comprador.' },
            evento_id: { required: 'Selecione um evento.' },
            data: { required: 'A data é obrigatória.' },
            quantidade: {
                required: 'A quantidade é obrigatória.',
                min: 'A quantidade deve ser pelo menos 1.'
            },
            total: {
                required: 'O total é obrigatório.',
                min: 'O total não pode ser negativo.'
            }
        }
    });

});