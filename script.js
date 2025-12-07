function getDB(key) {
  return JSON.parse(localStorage.getItem(key)) || [];
}

function setDB(key, data) {
  localStorage.setItem(key, JSON.stringify(data));
}

function getCurrentUserId() {
  return sessionStorage.getItem('currentUserId');
}

function getCurrentUser() {
    const userId = getCurrentUserId();
    if (!userId) return null;
    const allUsers = getDB('users');
    return allUsers.find(u => u.id === userId) || null;
}

document.addEventListener('DOMContentLoaded', () => {
    const formCadastro = document.getElementById('form-cadastro');
    if (!formCadastro) return; 

    formCadastro.addEventListener('submit', (event) => {
        event.preventDefault(); 
        const nome = document.getElementById('nome').value;
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;

        if (!nome || !email || !senha) {
            alert('Por favor, preencha todos os campos.');
            return;
        }

        const users = getDB('users');
        if (users.find(u => u.email === email)) {
            alert('Este e-mail já está cadastrado!');
            return;
        }

        const novoUsuario = {
            id: 'user_' + Date.now(),
            nome: nome,
            email: email,
            senha: senha
        };

        users.push(novoUsuario);
        setDB('users', users);
        alert('Cadastro realizado com sucesso!');
        window.location.href = 'login.html'; 
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const formLogin = document.getElementById('form-login');
    if (!formLogin) return;

    formLogin.addEventListener('submit', (event) => {
        event.preventDefault(); 
        const email = document.getElementById('email').value;
        const senha = document.getElementById('senha').value;
        const users = getDB('users');
        const usuario = users.find(u => u.email === email && u.senha === senha);

        if (usuario) {
            sessionStorage.setItem('currentUserId', usuario.id);
            alert(`Bem-vindo de volta, ${usuario.nome}!`);
            window.location.href = 'consultatransacoes.html';
        } else {
            alert('E-mail ou senha incorretos.');
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('.tabela-transacoes tbody');
    if (!tableBody) return; 

    const addButton = document.querySelector('.adicionar-transacao');
    let transactions = []; 
    const currentUserId = getCurrentUserId();

    function renderTable() {
        tableBody.innerHTML = '';
        transactions.forEach(transaction => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${transaction.id}</td>
              <td>
                  <select class="tipo-transacao">
                      <option value="Receita" ${transaction.type === 'Receita' ? 'selected' : ''}>Receita</option>
                      <option value="Despesa" ${transaction.type === 'Despesa' ? 'selected' : ''}>Despesa</option>
                  </select>
              </td>
              <td><input type="text" class="descricao-transacao" value="${transaction.description}" placeholder="Ex: Salário, Conta de Luz"></td>
              <td><input type="text" class="valor-transacao" value="${transaction.value}" placeholder="R$ 0,00"></td>
              <td><input type="date" class="data-transacao" value="${transaction.date}"></td>
              <td class="actions-cell">
                  <button class="edit-button" data-id="${transaction.id}">Salvar <i class="fa-solid fa-save"></i></button>
                  <button class="delete-button" data-id="${transaction.id}">Excluir <i class="fa-solid fa-trash"></i></button>
              </td>
            `;
            tableBody.appendChild(tr);
        });
    }

    function addTransaction() {
        const allTransactions = getDB('transactions');
        const newId = allTransactions.length > 0 ? Math.max(...allTransactions.map(t => t.id)) + 1 : 1;
        
        const newTransaction = {
            id: newId,
            type: 'Receita',
            description: '',
            value: '',    
            date: new Date().toISOString().slice(0, 10),
            userId: currentUserId
        };
        
        transactions.push(newTransaction);
        allTransactions.push(newTransaction);
        setDB('transactions', allTransactions); 
        renderTable();
    }

    function saveTransaction(id, rowElement) {
        const transactionToUpdate = transactions.find(t => t.id === id);
        if (transactionToUpdate) {
            transactionToUpdate.type = rowElement.querySelector('.tipo-transacao').value;
            transactionToUpdate.description = rowElement.querySelector('.descricao-transacao').value;
            transactionToUpdate.value = rowElement.querySelector('.valor-transacao').value;
            transactionToUpdate.date = rowElement.querySelector('.data-transacao').value;

            const allTransactions = getDB('transactions');
            const indexGlobal = allTransactions.findIndex(t => t.id === id);
            if (indexGlobal !== -1) {
                allTransactions[indexGlobal] = transactionToUpdate;
                setDB('transactions', allTransactions); 
            }

            alert(`Transação ${id} salva!`);
            rowElement.classList.add('salvo-recentemente');
            setTimeout(() => rowElement.classList.remove('salvo-recentemente'), 2000);
        }
    }

    function deleteTransaction(id) {
        if (confirm(`Tem certeza que deseja excluir a transação ${id}?`)) {
            transactions = transactions.filter(t => t.id !== id);
            let allTransactions = getDB('transactions');
            allTransactions = allTransactions.filter(t => t.id !== id);
            setDB('transactions', allTransactions);
            renderTable();
        }
    }

    if (!currentUserId) {
        alert('Você precisa fazer login para ver suas transações!');
        window.location.href = 'login.html'; 
        return;
    }
    
    const allTransactions = getDB('transactions');
    transactions = allTransactions.filter(t => t.userId === currentUserId);
    
    addButton.addEventListener('click', addTransaction);

    tableBody.addEventListener('click', (event) => {
        const editButton = event.target.closest('.edit-button');
        if (editButton) {
            saveTransaction(Number(editButton.dataset.id), editButton.closest('tr'));
        }
        const deleteButton = event.target.closest('.delete-button');
        if (deleteButton) {
            deleteTransaction(Number(deleteButton.dataset.id));
        }
    });
    
    renderTable();
});

document.addEventListener('DOMContentLoaded', () => {
    const emailInput = document.querySelector('#Seu-email');
    if (!emailInput) return; 

    const cadastroButton = document.querySelector('.botao-cadastro');
    const bancosImage = document.querySelector('.imagem-banco');
    const logo = document.querySelector('.logo');

    bancosImage.addEventListener('mouseover', () => {
        bancosImage.style.transform = 'scale(1.03)';
        bancosImage.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.2)';
        bancosImage.style.transition = 'transform 0.3s ease, boxShadow 0.3s ease';
    });
    bancosImage.addEventListener('mouseout', () => {
        bancosImage.style.transform = 'scale(1)';
        bancosImage.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    });

     logo.addEventListener('click', () => {
        alert('Bem-vindo ao FinUp! Organize suas finanças de forma simples e gratuita.');
        logo.style.transform = 'rotate(360deg)';
        logo.style.transition = 'transform 0.5s';
        setTimeout(() => {
            logo.style.transform = 'rotate(0deg)';
        }, 500);
    });

    cadastroButton.addEventListener('click', (event) => {
        const email = emailInput.value;
        if (!email.includes('@')) {
            alert('Por favor, digite um e-mail válido antes de continuar.');
            event.preventDefault(); 
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const tabelaExtrato = document.querySelector('.tabela-extrato');
    if (!tabelaExtrato) return; 

    const currentUserId = getCurrentUserId();
    const currentUser = getCurrentUser(); 

    if (!currentUserId || !currentUser) {
        alert('Você precisa fazer login para ver seu extrato!');
        window.location.href = 'login.html'; 
        return;
    }

    const titulo = document.getElementById('extrato-titulo');
    const totalReceitaEl = document.getElementById('total-receita');
    const totalDespesaEl = document.getElementById('total-despesa');
    const saldoFinalEl = document.getElementById('saldo-final');
    const tableBody = tabelaExtrato.querySelector('tbody');

    const allTransactions = getDB('transactions');
    const userTransactions = allTransactions.filter(t => t.userId === currentUserId);

    let totalReceita = 0;
    let totalDespesa = 0;

    userTransactions.forEach(transacao => {
        const valor = parseFloat(transacao.value) || 0; 
        if (transacao.type === 'Receita') {
            totalReceita += valor;
        } else if (transacao.type === 'Despesa') {
            totalDespesa += valor;
        }
    });

    const saldoFinal = totalReceita - totalDespesa;

    titulo.textContent = `Extrato de ${currentUser.nome}`;

    totalReceitaEl.textContent = `R$ ${totalReceita.toFixed(2)}`;
    totalDespesaEl.textContent = `R$ ${totalDespesa.toFixed(2)}`;
    saldoFinalEl.textContent = `R$ ${saldoFinal.toFixed(2)}`;

    if (saldoFinal < 0) {
        saldoFinalEl.style.color = '#dc3545';
    } else {
        saldoFinalEl.style.color = '#28a745';
    }

    tableBody.innerHTML = ''; 
    userTransactions.forEach(transacao => {
        const tr = document.createElement('tr');
        const [ano, mes, dia] = transacao.date.split('-');
        const dataFormatada = `${dia}/${mes}/${ano}`;
        const valorFormatado = `R$ ${(parseFloat(transacao.value) || 0).toFixed(2)}`;

        tr.innerHTML = `
            <td>${transacao.type}</td>
            <td>${transacao.description}</td>
            <td>${valorFormatado}</td>
            <td>${dataFormatada}</td>
        `;
        tableBody.appendChild(tr);
    });
});