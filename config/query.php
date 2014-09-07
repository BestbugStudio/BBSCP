<?
	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/

class Query{

	public function login($json_data){
		$json_data = json_decode($json_data,true);
		return "SELECT * FROM bbscp_admin_user WHERE nickname = '".$json_data['nickname']."' AND password = '".$json_data['password']."';";
	}

	/*** USER QUERIES ***/
	public function addNewUser($json_data){
		$json_data = json_decode($json_data,true);
		return "INSERT INTO bbscp_admin_user (nickname,password,firstname,lastname,mail,confirmed) VALUES ('".$json_data['nickname']."','".$json_data['password']."','".$json_data['firstname']."','".$json_data['lastname']."','".$json_data['mail']."',".$json_data['confirmed'].");";
	}
	public function getAllUsers(){
		return "SELECT idUser, nickname, mail, confirmed FROM bbscp_admin_user;";
	}
	public function getUserFromId($id){
		return "SELECT idUser, nickname, mail, confirmed FROM bbscp_admin_user WHERE idUser = $id;";
	}
	public function updateUser($json_data){
		return "UPDATE bbscp_admin_user SET nickname='".$json_data['nickname']."', $password='".$json_data['password']."', firstname='".$json_data['firstname']."', lastname='".$json_data['lastname']."', mail='".$json_data['mail']."' WHERE idUser=".$json_data['id'].";";
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
	public function addNewArticle($json_data){
		if($ftimg == ""){
			$ftimg="defaultimage.jpg";
		}
		return "INSERT INTO articles (title,content,category,pubdate,featured_image,featured_link) VALUES ('".$json_data['title']."','".$json_data['content']."','".$json_data['category']."','".$json_data['pubdate']."','".$json_data['ftimg']."','".$json_data['link']."');";
	}
	public function updateArticle($json_data){
		
		$query = "UPDATE articles SET title='".$json_data['title']."',content='".$json_data['content']."',category=".$json_data['category'].",pubdate='".$json_data['pubdate']."',featured_link='".$json_data['link']."'";

		if($json_data['ftimg'] != "")
			$query .= ",featured_image='".$json_data['ftimg']."'";
		
		return $query.", WHERE idArticle=".$json_data['id'].";";
	}
	public function deleteArticle($id){
		return "DELETE FROM articles WHERE idArticle=$id;";
	}

	/*** CATEGORIE QUERIES ***/
	public function getCategoryFromId($id){
		return "SELECT idCategory, category_name FROM categories WHERE idCategory = $id;";
	}
	public function getAllCategories(){
		return "SELECT idCategory, category_name FROM categories;";
	}
	public function addNewCategory($json_data){
		return "INSERT INTO categories (category_name) VALUES ('".$json_data['category_name']."');";
	}
	public function updateCategory($json_data){
		return "UPDATE categories SET category_name='".$json_data['category_name']."' WHERE idCategory=".$json_data['id'].";";
	}
	public function deleteCategory($id){
		return "DELETE FROM categories WHERE idCategory=$id;";
	}

	/*** MENU QUERIES ***/	

	public function getAllAdminMenu(){
		return "SELECT idMenu, menu_title, static, category, submenu_of, options, modulename  FROM bbscp_admin_menu ORDER BY modulename;";
	}
	public function getAdminMenuFromId($id){
		return "SELECT idMenu, menu_title, static, category, submenu_of FROM bbscp_admin_menu WHERE idMenu = $id;";
	}
	public function getAllSiteMenu(){
		return "SELECT idMenu, menu_title, static, category, submenu_of FROM site_menu;";
	}
	public function getSiteMenuFromId($id){
		return "SELECT idMenu, menu_title, static, category, submenu_of FROM site_menu WHERE idMenu = $id;";
	}
	public function addNewSiteMenu($json_data){
		$json_data = json_decode($json_data,true);
		return "INSERT INTO site_menu (menu_title,category,static,submenu_of) VALUES ('".$json_data['menu_title']."',".$json_data['category'].",".$json_data['static'].",".$json_data['submenu_of'].");";
	}
	public function updateSiteMenu($json_data){
		$json_data = json_decode($json_data,true);
		return "UPDATE site_menu SET menu_title='".$json_data['menu_title']."', category=".$json_data['category'].", static=".$json_data['static'].", submenu_of=".$json_data['submenu_of']." WHERE idMenu=".$json_data['id'].";";
	}
	public function deleteSiteMenu($id){
		return "DELETE FROM site_menu WHERE idMenu=$id;";
	}

}


	/********************************************/
	/******* BestBug Studio Control Panel *******/
	/********************************************/
?>