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

$('#lk-mostrar-menu').on('click.__mostrarMenu', function (evt) {
    evt.stopPropagation();

    var $dlx_grid = $('#dlx-grid'),
        $menu = $('.menu-principal');

    if ($menu.position().left === 0) {
        // Esconder o menu
        $dlx_grid.removeClass('-mostrar-menu');
        $dlx_grid.addClass('-esconder-menu');
    } else {
        // Mostrar o menu
        $dlx_grid.removeClass('-esconder-menu');
        $dlx_grid.addClass('-mostrar-menu');
    }
});

$(window).on('click.__mostrarMenu', function () {
    var $dlx_grid = $('#dlx-grid');

    // Esconder o menu
    $dlx_grid.removeClass('-mostrar-menu');
    $dlx_grid.addClass('-esconder-menu');
});
