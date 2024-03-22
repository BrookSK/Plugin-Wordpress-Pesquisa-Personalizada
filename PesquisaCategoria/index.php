<?php
/**
 * Plugin Name: Widget de Pesquisa com URL Atual
 * Description: Um plugin que adiciona um widget de pesquisa mantendo a URL atual.
 * Version:     1.0
 * Author:      MW Online | Lucas
 * Author URI:  https://mwonline.com.br/
 * Text Domain: widget-pesquisa-url-atual
 */

// Registrando o widget
function custom_search_widget_init() {
    register_widget( 'Custom_Search_Widget' );
}
add_action( 'widgets_init', 'custom_search_widget_init' );

// Classe do widget
class Custom_Search_Widget extends WP_Widget {

    // Configurações básicas do widget
    function __construct() {
        parent::__construct(
            'custom_search_widget',
            __('Pesquisa com URL Atual', 'custom_search_widget_domain'),
            array( 'description' => __( 'Widget de pesquisa mantendo a URL atual', 'custom_search_widget_domain' ), )
        );
    }

    // Formulário de exibição do widget no painel de administração
    public function form( $instance ) {
        // Ajuste de configurações se necessário
    }

    // Exibição do widget na área de widget
    public function widget( $args, $instance ) {
        // Obtendo a URL atual
        global $wp;
        $current_url = home_url( add_query_arg( array(), $wp->request ) ) . '/';

        // Saída do conteúdo do widget
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters( 'widget_title', __('Buscar na Categoria', 'custom_search_widget_domain') ) . $args['after_title']; ?>

        <form role="search" method="get" id="searchform" action="<?php echo esc_url( $current_url ); ?>">
            <div>
                <label class="screen-reader-text" for="s"><?php _e('Pesquisar por:', 'custom_search_widget_domain'); ?></label>
                <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                <br><br>
                <input type="submit" id="searchsubmit" value="<?php echo esc_attr_x('Pesquisar', 'submit button', 'custom_search_widget_domain'); ?>" />
            </div>
        </form>

        <?php echo $args['after_widget'];
    }
}
?>