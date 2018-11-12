let SessionLoad = 1
if &cp | set nocp | endif
let s:so_save = &so | let s:siso_save = &siso | set so=0 siso=0
let v:this_session=expand("<sfile>:p")
silent only
exe "cd " . escape(expand("<sfile>:p:h"), ' ')
if expand('%') == '' && !&modified && line('$') <= 1 && getline(1) == ''
  let s:wipebuf = bufnr('%')
endif
set shortmess=aoO
badd +9 index.php
badd +1 .htaccess
badd +1 config/config.php
badd +2 config/database.php
badd +1 core/route.php
badd +1 core/model.php
badd +24 core/loader.php
badd +1 core/controller.php
badd +48 core/view.php
badd +1 app/controllers/home.php
badd +1 core/tool.php
badd +0 app/html/home.html
badd +1 app/views/home.php
badd +0 app/html/header.html
argglobal
silent! argdel *
$argadd ~/cursus/mvc_141/index.php
edit .htaccess
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
wincmd _ | wincmd |
split
wincmd _ | wincmd |
split
2wincmd k
wincmd w
wincmd w
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
set winminheight=1 winheight=1 winminwidth=1 winwidth=1
exe '1resize ' . ((&lines * 18 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 84 + 182) / 364)
exe '2resize ' . ((&lines * 17 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 84 + 182) / 364)
exe '3resize ' . ((&lines * 39 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 84 + 182) / 364)
exe '4resize ' . ((&lines * 20 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 84 + 182) / 364)
exe '5resize ' . ((&lines * 47 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 84 + 182) / 364)
exe '6resize ' . ((&lines * 7 + 42) / 84)
exe 'vert 6resize ' . ((&columns * 84 + 182) / 364)
exe '7resize ' . ((&lines * 38 + 42) / 84)
exe 'vert 7resize ' . ((&columns * 109 + 182) / 364)
exe '8resize ' . ((&lines * 37 + 42) / 84)
exe 'vert 8resize ' . ((&columns * 109 + 182) / 364)
exe '9resize ' . ((&lines * 32 + 42) / 84)
exe 'vert 9resize ' . ((&columns * 84 + 182) / 364)
exe '10resize ' . ((&lines * 43 + 42) / 84)
exe 'vert 10resize ' . ((&columns * 84 + 182) / 364)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 9) / 18)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/config/database.php') | buffer ~/cursus/mvc_141/config/database.php | else | edit ~/cursus/mvc_141/config/database.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 6 - ((5 * winheight(0) + 8) / 17)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
6
normal! 026|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/config/config.php') | buffer ~/cursus/mvc_141/config/config.php | else | edit ~/cursus/mvc_141/config/config.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 21 - ((19 * winheight(0) + 19) / 39)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
21
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/route.php') | buffer ~/cursus/mvc_141/core/route.php | else | edit ~/cursus/mvc_141/core/route.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 13 - ((12 * winheight(0) + 10) / 20)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
13
normal! 078|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/index.php') | buffer ~/cursus/mvc_141/index.php | else | edit ~/cursus/mvc_141/index.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 17 - ((16 * winheight(0) + 23) / 47)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
17
normal! 030|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/tool.php') | buffer ~/cursus/mvc_141/core/tool.php | else | edit ~/cursus/mvc_141/core/tool.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=3
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 1 - ((0 * winheight(0) + 3) / 7)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
1
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/controller.php') | buffer ~/cursus/mvc_141/core/controller.php | else | edit ~/cursus/mvc_141/core/controller.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
let s:l = 25 - ((24 * winheight(0) + 19) / 38)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
25
normal! 036|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/view.php') | buffer ~/cursus/mvc_141/core/view.php | else | edit ~/cursus/mvc_141/core/view.php | endif
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
36
normal! zo
43
normal! zo
45
normal! zo
let s:l = 14 - ((13 * winheight(0) + 18) / 37)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
14
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/model.php') | buffer ~/cursus/mvc_141/core/model.php | else | edit ~/cursus/mvc_141/core/model.php | endif
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
7
normal! zo
16
normal! zo
let s:l = 22 - ((21 * winheight(0) + 16) / 32)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
22
normal! 013|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/loader.php') | buffer ~/cursus/mvc_141/core/loader.php | else | edit ~/cursus/mvc_141/core/loader.php | endif
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
17
normal! zo
let s:l = 28 - ((27 * winheight(0) + 21) / 43)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
28
normal! 013|
lcd ~/cursus/mvc_141
wincmd w
exe '1resize ' . ((&lines * 18 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 84 + 182) / 364)
exe '2resize ' . ((&lines * 17 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 84 + 182) / 364)
exe '3resize ' . ((&lines * 39 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 84 + 182) / 364)
exe '4resize ' . ((&lines * 20 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 84 + 182) / 364)
exe '5resize ' . ((&lines * 47 + 42) / 84)
exe 'vert 5resize ' . ((&columns * 84 + 182) / 364)
exe '6resize ' . ((&lines * 7 + 42) / 84)
exe 'vert 6resize ' . ((&columns * 84 + 182) / 364)
exe '7resize ' . ((&lines * 38 + 42) / 84)
exe 'vert 7resize ' . ((&columns * 109 + 182) / 364)
exe '8resize ' . ((&lines * 37 + 42) / 84)
exe 'vert 8resize ' . ((&columns * 109 + 182) / 364)
exe '9resize ' . ((&lines * 32 + 42) / 84)
exe 'vert 9resize ' . ((&columns * 84 + 182) / 364)
exe '10resize ' . ((&lines * 43 + 42) / 84)
exe 'vert 10resize ' . ((&columns * 84 + 182) / 364)
tabedit ~/cursus/mvc_141/core/controller.php
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
1wincmd k
wincmd w
wincmd w
wincmd w
wincmd t
set winminheight=1 winheight=1 winminwidth=1 winwidth=1
exe '1resize ' . ((&lines * 43 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 90 + 182) / 364)
exe '2resize ' . ((&lines * 36 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 90 + 182) / 364)
exe '3resize ' . ((&lines * 32 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 90 + 182) / 364)
exe '4resize ' . ((&lines * 47 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 90 + 182) / 364)
exe 'vert 5resize ' . ((&columns * 90 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 91 + 182) / 364)
argglobal
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
8
normal! zo
let s:l = 80 - ((34 * winheight(0) + 21) / 43)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
80
normal! 05|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/core/view.php') | buffer ~/cursus/mvc_141/core/view.php | else | edit ~/cursus/mvc_141/core/view.php | endif
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
36
normal! zo
43
normal! zo
45
normal! zo
53
normal! zo
73
normal! zo
let s:l = 71 - ((30 * winheight(0) + 18) / 36)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
71
normal! 029|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/app/controllers/home.php') | buffer ~/cursus/mvc_141/app/controllers/home.php | else | edit ~/cursus/mvc_141/app/controllers/home.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
let s:l = 10 - ((9 * winheight(0) + 16) / 32)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/app/views/home.php') | buffer ~/cursus/mvc_141/app/views/home.php | else | edit ~/cursus/mvc_141/app/views/home.php | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
5
normal! zo
7
normal! zo
let s:l = 11 - ((10 * winheight(0) + 23) / 47)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
11
normal! 0
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/app/html/home.html') | buffer ~/cursus/mvc_141/app/html/home.html | else | edit ~/cursus/mvc_141/app/html/home.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=1
setlocal fml=1
setlocal fdn=20
setlocal fen
19
normal! zo
19
normal! zo
19
normal! zo
let s:l = 20 - ((19 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
20
normal! 02|
lcd ~/cursus/mvc_141
wincmd w
argglobal
if bufexists('~/cursus/mvc_141/app/html/header.html') | buffer ~/cursus/mvc_141/app/html/header.html | else | edit ~/cursus/mvc_141/app/html/header.html | endif
setlocal fdm=indent
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=4
setlocal fml=1
setlocal fdn=20
setlocal fen
17
normal! zo
25
normal! zo
let s:l = 29 - ((28 * winheight(0) + 40) / 80)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
29
normal! 02|
lcd ~/cursus/mvc_141
wincmd w
6wincmd w
exe '1resize ' . ((&lines * 43 + 42) / 84)
exe 'vert 1resize ' . ((&columns * 90 + 182) / 364)
exe '2resize ' . ((&lines * 36 + 42) / 84)
exe 'vert 2resize ' . ((&columns * 90 + 182) / 364)
exe '3resize ' . ((&lines * 32 + 42) / 84)
exe 'vert 3resize ' . ((&columns * 90 + 182) / 364)
exe '4resize ' . ((&lines * 47 + 42) / 84)
exe 'vert 4resize ' . ((&columns * 90 + 182) / 364)
exe 'vert 5resize ' . ((&columns * 90 + 182) / 364)
exe 'vert 6resize ' . ((&columns * 91 + 182) / 364)
tabnext 2
if exists('s:wipebuf') && s:wipebuf != bufnr('%')
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
