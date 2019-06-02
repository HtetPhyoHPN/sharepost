<?php

class Posts extends Controller {

    public function __construct() {
        if(!isLoggedIn()) {
            redirect();
        }

        //load post model in post controller
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index() {

        //get posts
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    public function add() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            //Validate title
            if(empty($data['title'])) {
                $data['title_err'] = 'Please give a title';
            }

            //Validate body
            if(empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }

            //Make sure no errors
            if(empty($data['title_err']) && empty($data['body_err'])) {
                //validated
                if($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Uploaded');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                //load view with errors
                $this->view('posts/add', $data);
            }

        }

        $data = [
            'title' => '',
            'body' => ''
        ];

        $this->view('posts/add', $data);
   }

   	public function delete($id) {

		$post = $this->postModel->getPostById($id);

		if($post->user_id != $_SESSION['user_id']) {
			redirect('posts');
		}
       
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

			if($this->postModel->deletePost($id)) {
				flash('post_message', 'Post Removed');
				redirect('posts');
			} else {
				flash('post_message', 'Something Went wrong.', 'alert-danger');
				redirect('posts');
			}

		} else {
			flash('post_message', 'Please delete from UI.', 'alert-info');
				redirect('posts');
		}
   }

   public function edit($id) {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //collect post data from FORM SUBMIT into $data array
        $data = [
            'id' => $id,
            'title' => trim($_POST['title']),
            'body' => trim($_POST['body']),
            'user_id' => $_SESSION['user_id'],
            'title_err' => '',
            'body_err' => ''
        ];

        //Validate title
        if(empty($data['title'])) {
            $data['title_err'] = 'Please give a title';
        }

        //Validate body
        if(empty($data['body'])) {
            $data['body_err'] = 'Please enter body text';
        }

        //Make sure no errors
        //if errors are empty, this is ok for next step 
        //validated
        if(empty($data['title_err']) && empty($data['body_err'])) {
            
            //call method from post MODEL and feed it $data array
            //if true, update SUCCESS !!!
            if($this->postModel->updatePost($data)) {
                flash('post_message', 'Post Updated oooooo');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            //load view with errors
            $this->view('posts/edit', $data);
        }

    }
    //get existing post from model
    $post = $this->postModel->getPostById($id);

    //check for owner -> load $post ONLY when current user is the post owner
    if($post->user_id != $_SESSION['user_id']) {
        redirect('posts');
    }

    //post data
    $data = [
        'id' => $id,
        'title' => $post->title,
        'body' => $post->body
    ];

    //pass collected post data array to the view and load the view for the user who types /posts/edit/19 in the url
    $this->view('posts/edit', $data);
}

   public function show($id) {

		$post = $this->postModel->getPostById($id);
		$user = $this->userModel->getUserById($post->user_id);

       	$data = [
			'post' => $post,
			'user' => $user
       	];

       $this->view('posts/show', $data);
   }
}