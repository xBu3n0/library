<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("welcome");
});


// Adicionar gate para apenas admin realizar alterações em campos diferentes de estoque

/**
Usuários:
  id: string
  name: string
  email: email
  password: string
  isAdmin: bool

Carrinhos:
  usuárioId: string
  livroId: string
  quantidade: number (* Caso quantidade = 0, apagar tabela *)

// Tabela utilizada para avisar o usuário de um certo livro está em oferta
Whitelists:
  usuárioId: string
  livroId: string

// Usuários que querem receber notificações de lançamento de livros
AvisoLançamentoLivros:
  usuárioId: string

AvisoLançamentoTópicos:
  usuárioId: string
  tópicoId: string

Livros:
  id: string
  name: string
  preço: string
  estoque: string

Promoções:
  id: string
  livroId: string
  preço: string
  dataInicio: date
  dataFim: date

LivrosAutores:
  livroId: string
  autorId: string

Autores:
  id: string
  name: string

HistoricoCompra:
  id: string
  quantidadeLivros: number
  preçoTotal: number

LivroComprado:
  historicoCompraId: string
  livroId: string
  quantidade: string
  preço: number
  preçoTotal: number
  data: date

LivrosTópicos:
  livroId: string
  tópicoId: string

Tópicos:
  id: string
  name: string
  */