$("#lk-mostrar-menu").on("click.__mostrarMenu",function(o){o.stopPropagation();var s=$("#dlx-grid");0===$(".menu-principal").position().left?(s.removeClass("-mostrar-menu"),s.addClass("-esconder-menu")):(s.removeClass("-esconder-menu"),s.addClass("-mostrar-menu"))}),$(window).on("click.__mostrarMenu",function(){var o=$("#dlx-grid");o.removeClass("-mostrar-menu"),o.addClass("-esconder-menu")}),$("#lk-menu-usuario").on("click.__menuUsuario",function(o){o.stopPropagation();var s=$("#lk-menu-usuario + .opcoes-usuario");s.is(":visible")?s.fadeOut("fast"):s.fadeIn("fast")}),$(window).on("click.__menuUsuario",function(){$("#lk-menu-usuario + .opcoes-usuario:visible").fadeOut()});