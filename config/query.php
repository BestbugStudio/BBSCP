<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

class Query{

	public function login($nick,$pwd){
		return "SELECT * FROM bbscp_admin_user WHERE nickname = '$nick' AND password = '$pwd';";
	}

	/*** USER QUERIES ***/
	public function addNewUser($nickname,$password,$firstname,$lastname,$mail,$confirmed){
		return "INSERT INTO bbscp_admin_user (nickname,password,firstname,lastname,mail,confirmed) VALUES ('$nickname','$password','$firstname','$lastname','$mail',$confirmed);";
	}
	public function getAllUsers(){
		return "SELECT idUser, nickname, mail, confirmed FROM bbscp_admin_user;";
	}
	public function getUserFromId($id){
		return "SELECT idUser, nickname, mail, confirmed FROM bbscp_admin_user WHERE idUser = $id;";
	}
	public function updateUser($id, $nickname, $password, $firstname,$lastname,$mail){
		return "UPDATE bbscp_admin_user SET nickname='$nickname', $password='$password', firstname='$firstname', lastname='$lastname', mail='$mail' WHERE idUser=$id;";
	}
	public function updateUserSetConfirmed($id, $conf){
		return "UPDATE bbscp_admin_user SET confirmed=$conf WHERE idUser=$id;";
	}
	public function deleteUser($id){
		return "DELETE FROM bbscp_admin_user WHERE idUser=$id;";
	}

	/*** ARTICLE QUERIES ***/
	public function getArticleFromId($id){
		return "SELECT idArticle, title, content, category, pubdate, featured_image, featured_link FROM articles WHERE idArticle = $id ORDER BY pubdate DESC;";
	}
	public function getAllarticlesInfo(){
		return "SELECT idArticle, title, category, pubdate, featured_image, featured_link FROM articles;";
	}
	public function getArticlesFromCategory($cat){
		return "SELECT idArticle, title, content, category, pubdate, featured_image, featured_link FROM articles WHERE category=$cat ORDER BY pubdate DESC;";
	}
	public function addNewArticle($title,$content,$category,$pubdate,$ftimg, $link){
		if($ftimg == ""){
			$ftimg="defaultimage.jpg";
		}
		return "INSERT INTO articles (title,content,category,pubdate,featured_image, featured_link) VALUES ('$title','$content','$category','$pubdate','$ftimg','$link');";
	}
	public function updateArticle($id,$title,$content,$category,$pubdate,$ftimg, $link){
		if($ftimg != "")
			return "UPDATE articles SET title='$title',content='$content',category=$category,pubdate='$pubdate',featured_image='$ftimg',featured_link='$link' WHERE idArticle=$id;";
		else
			return "UPDATE articles SET title='$title',content='$content',category=$category,pubdate='$pubdate',featured_link='$link' WHERE idArticle=$id;";
	}
	public function deleteArticle($id){
		return "DELETE FROM articles WHERE idArticle=$id;";
	}





	/*** Get ***/

		/*** Menus ***/
		// public function getAdminMenu(){
		// 	return "SELECT idMenu, menu_title, static, category, submenu_of FROM bbscp_admin_menu;";
		// }
		// public function getAdminMenuFromId($id){
		// 	return "SELECT idMenu, menu_title, static, category, submenu_of FROM bbscp_admin_menu WHERE idMenu = $id;";
		// }
		// public function getSiteMenu(){
		// 	return "SELECT idMenu, menu_title, static, category, submenu_of FROM site_menu;";
		// }
		// public function getSiteMenuFromId($id){
		// 	return "SELECT idMenu, menu_title, static, category, submenu_of FROM site_menu WHERE idMenu = $id;";
		// }

		/*** articles ***/
		

		/*** categories ***/
		// public function getcategories(){
		// 	return "SELECT idCategory, category_name FROM categories;";
		// }
		// public function getCategoryFromId($id){
		// 	return "SELECT idCategory, category_name FROM categories WHERE idCategory = $id;";
		// }

		/*** Users ***/
		


	/*** Add ***/

	
	// public function addNewCategory($category_name){
	// 	return "INSERT INTO categories (category_name) VALUES ('$category_name');";
	// }
	// public function addNewMenu($menu_title,$category,$static, $submenu_of){
	// 	return "INSERT INTO site_menu (menu_title,category,static,submenu_of) VALUES ('$menu_title',$category,$static,$submenu_of);";
	// }

	/*** Update ***/
	
	// public function updateCategory($id,$category_name){
	// 	return "UPDATE categories SET category_name='$category_name' WHERE idCategory=$id;";
	// }
	// public function updateMenu($id,$menu_title,$category,$static,$submenu_of){
	// 	return "UPDATE site_menu SET menu_title='$menu_title', category=$category, static=$static, submenu_of=$submenu_of WHERE idMenu=$id;";
	// }


	/*** Delete ***/
	
	// public function deleteCategory($id){
	// 	return "DELETE FROM categories WHERE idCategory=$id;";
	// }
	// public function deleteMenu($id){
	// 	return "DELETE FROM site_menu WHERE idMenu=$id;";
	// }
	

}


	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>