# testePonto

Teste feito para uma empresa visando fazer um sistema de sistema de ponto que envolva os seguintes requisitos
- Login de Usuário Admin
- Login de Usuário Cadastrado
- Cadastro de Usuário
- Marcação de Ponto


## Explicação Resumida para Testar o Projeto

O projeto tem duas pastas, a que corresponde ao Frontend, e outra que corresponde ao Backend. Por o sistema de conexão sem feito através de uma URL com o sistema Axios, a solicitação é feita requisitando a seguinte URL
- http://localhost:8080/

Sendo assim, é <b>obrigatório</b> para esse exemplo, que o Backend seja rodado separatemente, requisitando essa mesma URL, para ser feito a conexão.

<i>Lembrando que o comando "./" pode ser alterado dependendo da configuração que preferir em seu diretório. Ex: "./php-sistema-ponto-backend"</i>

```
php -S 0.0.0.0:8080 -t ./
```

O sistema já vem em seu Banco de Dados um usuário Adminstrador para poder fazer manutenção no sistema internamente com o seu login
```
Username: admin
Senha: admin
```

## Tecnologias Usadas para a Concepção do Projeto

Segue uma breve lista das ferramentas usadas para a conclusão desse projeto.

- Vue [(Link)](https://vuejs.org/)
- Vuetify [(Link)](https://vuetifyjs.com)
- AXIOS [(Link)](https://axios-http.com/)
- MDI (Material Design Icons) [(Link)](https://pictogrammers.com/library/mdi/)
- PHP
- Composer
- DBeaver [(Link)](https://dbeaver.io/)
- SQLite

## Configuração de IDE recomendada (template)

[VSCode](https://code.visualstudio.com/) + [Volar](https://marketplace.visualstudio.com/items?itemName=Vue.volar) (and disable Vetur) + [TypeScript Vue Plugin (Volar)](https://marketplace.visualstudio.com/items?itemName=Vue.vscode-typescript-vue-plugin).

## Customize configuration

See [Vite Configuration Reference](https://vitejs.dev/config/).

## Project Setup

```sh
npm install
```

### Compile 

```sh
npm run dev
```

### Compile and Minify for Production

```sh
npm run build
```

## Imagens de Exemplo

#### Imagem antes do Login
![image01](/doc/img01.jpg "Image 01")

#### Imagem depois do Login

![image02](/doc/img02.jpg "Image 02")

#### Exemplo da Responsividade Mobile

![mobile](/doc/img03.jpg "Mobile")
