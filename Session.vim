let SessionLoad = 1
if &cp | set nocp | endif
let s:so_save = &so | let s:siso_save = &siso | set so=0 siso=0
let v:this_session=expand("<sfile>:p")
silent only
silent tabonly
exe "cd " . escape(expand("<sfile>:p:h"), ' ')
if expand('%') == '' && !&modified && line('$') <= 1 && getline(1) == ''
  let s:wipebuf = bufnr('%')
endif
set shortmess=aoO
badd +1 config/config.php
badd +1 index.php
badd +73 core/loader.php
badd +1 core/controller.php
badd +15 core/view.php
badd +3 core/model.php
badd +1 app/entity/user.php
badd +1 config/database.php
badd +9 app/controllers/home.php
badd +3 app/html/home.html
badd +35 core/core.php
badd +16 core/modules.php
badd +15 core/db.php
badd +1 app/views/home.php
badd +1 app/html/layout/default.html
badd +1 app/html/prompter.html
badd +4 app/html/header.html
badd +1 app/assets/css/style.css
argglobal
silent! argdel *
tabnew
tabnew
tabnext -2
edit config/database.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
3wincmd h
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 8 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 84 + 182) / 364)
exe '2resize ' . ((&lines * 37 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 84 + 182) / 364)
exe '3resize ' . ((&lines * 33 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 84 + 182) / 364)
exe 'vert 4resize ' . ((&columns * 84 + 182) / 364)
exe 'vert 5resize ' . ((&columns * 96 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 97 + 182) / 364)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 6 - ((5 * winheight(0) + 4) / 8)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 05|
wincmd w
argglobal
if bufexists('config/config.php') | buffer config/config.php | else | edit config/config.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 4 - ((3 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
4
normal! 0
wincmd w
argglobal
if bufexists('app/entity/user.php') | buffer app/entity/user.php | else | edit app/entity/user.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 4 - ((3 * winheight(0) + 16) / 33)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
4
normal! 0
lcd ~/cursus/matcha
wincmd w
argglobal
if bufexists('~/cursus/matcha/index.php') | buffer ~/cursus/matcha/index.php | else | edit ~/cursus/matcha/index.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
8
normal! zo
let s:l = 13 - ((12 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/core.php') | buffer ~/cursus/matcha/core/core.php | else | edit ~/cursus/matcha/core/core.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
40
normal! zo
50
normal! zo
62
normal! zo
70
normal! zo
83
normal! zo
96
normal! zc
102
normal! zo
102
normal! zc
110
normal! zc
let s:l = 30 - ((29 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
30
normal! 09|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/loader.php') | buffer ~/cursus/matcha/core/loader.php | else | edit ~/cursus/matcha/core/loader.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
18
normal! zo
34
normal! zo
50
normal! zo
68
normal! zo
let s:l = 2 - ((1 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
2
normal! 0
wincmd w
exe '1resize ' . ((&lines * 8 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 84 + 182) / 364)
exe '2resize ' . ((&lines * 37 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 84 + 182) / 364)
exe '3resize ' . ((&lines * 33 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 84 + 182) / 364)
exe 'vert 4resize ' . ((&columns * 84 + 182) / 364)
exe 'vert 5resize ' . ((&columns * 96 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 97 + 182) / 364)
tabnext
edit ~/cursus/matcha/core/controller.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
2wincmd h
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe 'vert 1resize ' . ((&columns * 121 + 182) / 364)
exe '2resize ' . ((&lines * 58 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 120 + 182) / 364)
exe '3resize ' . ((&lines * 21 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 120 + 182) / 364)
exe '4resize ' . ((&lines * 40 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 121 + 182) / 364)
exe '5resize ' . ((&lines * 39 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 121 + 182) / 364)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
58
normal! zo
60
normal! zo
let s:l = 28 - ((27 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
28
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/view.php') | buffer ~/cursus/matcha/core/view.php | else | edit ~/cursus/matcha/core/view.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 85 - ((57 * winheight(0) + 29) / 58)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
85
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules.php') | buffer ~/cursus/matcha/core/modules.php | else | edit ~/cursus/matcha/core/modules.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 12 - ((11 * winheight(0) + 10) / 21)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
12
normal! 014|
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/db.php') | buffer ~/cursus/matcha/core/db.php | else | edit ~/cursus/matcha/core/db.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 2 - ((1 * winheight(0) + 20) / 40)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
2
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/model.php') | buffer ~/cursus/matcha/core/model.php | else | edit ~/cursus/matcha/core/model.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=5
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
exe 'vert 1resize ' . ((&columns * 121 + 182) / 364)
exe '2resize ' . ((&lines * 58 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 120 + 182) / 364)
exe '3resize ' . ((&lines * 21 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 120 + 182) / 364)
exe '4resize ' . ((&lines * 40 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 121 + 182) / 364)
exe '5resize ' . ((&lines * 39 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 121 + 182) / 364)
tabnext
edit ~/cursus/matcha/core/controller.php
set splitbelow splitright
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
wincmd _ | wincmd |
vsplit
3wincmd h
wincmd _ | wincmd |
split
1wincmd k
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
wincmd w
wincmd w
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
3wincmd k
wincmd w
wincmd w
wincmd w
wincmd t
set winminheight=0
set winheight=1
set winminwidth=0
set winwidth=1
exe '1resize ' . ((&lines * 20 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 92 + 182) / 364)
exe '2resize ' . ((&lines * 59 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 92 + 182) / 364)
exe '3resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 93 + 182) / 364)
exe '4resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 93 + 182) / 364)
exe '5resize ' . ((&lines * 48 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 93 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 92 + 182) / 364)
exe '7resize ' . ((&lines * 25 + 42) / 84)
exe 'vert 7resize ' . ((&columns * 84 + 182) / 364)
exe '8resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 8resize ' . ((&columns * 84 + 182) / 364)
exe '9resize ' . ((&lines * 10 + 42) / 84)
exe 'vert 9resize ' . ((&columns * 84 + 182) / 364)
exe '10resize ' . ((&lines * 27 + 42) / 84)
exe 'vert 10resize ' . ((&columns * 84 + 182) / 364)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
58
normal! zo
60
normal! zo
68
normal! zo
70
normal! zo
let s:l = 1 - ((0 * winheight(0) + 10) / 20)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/view.php') | buffer ~/cursus/matcha/core/view.php | else | edit ~/cursus/matcha/core/view.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
37
normal! zo
66
normal! zo
74
normal! zo
let s:l = 1 - ((0 * winheight(0) + 29) / 59)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/controllers/home.php') | buffer ~/cursus/matcha/app/controllers/home.php | else | edit ~/cursus/matcha/app/controllers/home.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 7 - ((6 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
7
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/views/home.php') | buffer ~/cursus/matcha/app/views/home.php | else | edit ~/cursus/matcha/app/views/home.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
let s:l = 11 - ((7 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
11
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/core/modules.php') | buffer ~/cursus/matcha/core/modules.php | else | edit ~/cursus/matcha/core/modules.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 9 - ((8 * winheight(0) + 24) / 48)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
9
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/layout/default.html') | buffer ~/cursus/matcha/app/html/layout/default.html | else | edit ~/cursus/matcha/app/html/layout/default.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
4
normal! zo
let s:l = 32 - ((31 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
32
normal! 07|
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/assets/css/style.css') | buffer ~/cursus/matcha/app/assets/css/style.css | else | edit ~/cursus/matcha/app/assets/css/style.css | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 12) / 25)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/header.html') | buffer ~/cursus/matcha/app/html/header.html | else | edit ~/cursus/matcha/app/html/header.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=2
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 7) / 15)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/prompter.html') | buffer ~/cursus/matcha/app/html/prompter.html | else | edit ~/cursus/matcha/app/html/prompter.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 2 - ((1 * winheight(0) + 5) / 10)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
2
normal! 0
wincmd w
argglobal
if bufexists('~/cursus/matcha/app/html/home.html') | buffer ~/cursus/matcha/app/html/home.html | else | edit ~/cursus/matcha/app/html/home.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 13) / 27)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
wincmd w
6wincmd w
exe '1resize ' . ((&lines * 20 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 92 + 182) / 364)
exe '2resize ' . ((&lines * 59 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 92 + 182) / 364)
exe '3resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 93 + 182) / 364)
exe '4resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 93 + 182) / 364)
exe '5resize ' . ((&lines * 48 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 93 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 92 + 182) / 364)
exe '7resize ' . ((&lines * 25 + 42) / 84)
exe 'vert 7resize ' . ((&columns * 84 + 182) / 364)
exe '8resize ' . ((&lines * 15 + 42) / 84)
exe 'vert 8resize ' . ((&columns * 84 + 182) / 364)
exe '9resize ' . ((&lines * 10 + 42) / 84)
exe 'vert 9resize ' . ((&columns * 84 + 182) / 364)
exe '10resize ' . ((&lines * 27 + 42) / 84)
exe 'vert 10resize ' . ((&columns * 84 + 182) / 364)
tabnext 3
if exists('s:wipebuf') && len(win_findbuf(s:wipebuf)) == 0
  silent exe 'bwipe ' . s:wipebuf
endif
unlet! s:wipebuf
set winheight=5 winwidth=84 shortmess=filnxtToO
set winminheight=1 winminwidth=10
let s:sx = expand("<sfile>:p:r")."x.vim"
if file_readable(s:sx)
  exe "source " . fnameescape(s:sx)
endif
let &so = s:so_save | let &siso = s:siso_save
doautoall SessionLoadPost
unlet SessionLoad
" vim: set ft=vim :
