/**
 * Tema painel-dlx 2017
 * @version: v1.17.08
 * @author: Diego Lepera
 *
 * Created by Diego Lepera on 2017-07-28. Please report any bug at
 * https://github.com/dlepera88-php/framework-dlx/issues
 *
 * The MIT License (MIT)
 * Copyright (c) 2017 Diego Lepera http://diegolepera.xyz/
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

$('#lk-menu-usuario').on('click.__menuUsuario', function (evt) {
    evt.stopPropagation();
    
    var $menu_usuario = $('#lk-menu-usuario + .opcoes-usuario');

    !$menu_usuario.is(':visible')
        ? $menu_usuario.fadeIn('fast')
        : $menu_usuario.fadeOut('fast');
});

$(window).on('click.__menuUsuario', function () {
    $('#lk-menu-usuario + .opcoes-usuario:visible').fadeOut();
});
