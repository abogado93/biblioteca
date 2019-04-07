<!-- BODY INIT -->
<div class="main-container" id="main-container">
	<script type="text/javascript">
		try{ace.settings.check('main-container' , 'fixed')}catch(e){}
	</script>
	
	<!-- LEFT MENU INIT -->
	<div id="sidebar" class="sidebar responsive">
		<script type="text/javascript">
			try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
		</script>
	
		<ul class="nav nav-list">
			<li class="">
                <a href="<?php echo URL . 'home/index' ?>">
					<i class="menu-icon fa fa-tachometer"></i>
					<span class="menu-text"><strong>Inicio</strong></span>
				</a>
	
				<b class="arrow"></b>
			</li>

            <li id="c_clientes">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-shopping-bag"></i>
                    <span class="menu-text">
					 Clientes
					</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li id="i_new_clientes">
                        <a href="<?php echo URL . 'clientes/new' ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Registrar cliente
                        </a>
                    </li>
                    <li id="i_list_clientes">
                        <a href="<?php echo URL . 'clientes/list' ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Listar clientes
                        </a>
                    </li>
                </ul>
            </li>

            <li id="c_users">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text">
					 Usuarios
					</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li id="i_users">
                        <a href="<?php echo URL . 'usuarios/list' ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Listar usuarios
                        </a>
                    </li>
                    <li id="i_add_user">
                        <a href="<?php echo URL . 'usuarios/new' ?>">
                            <i class="menu-icon fa fa-caret-right"></i>
                            Nuevo usuario
                        </a>
                    </li>
                </ul>
            </li>
		</ul><!-- /.nav-list -->
	
		<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
			<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
		</div>
	</div>

	<!-- MENU LEFT END -->