var express = require('express');
var router = express.Router();
var userCntl = require("../controllers/user");
var mainCntl = require("../controllers/home");
var recipeCntl = require("../controllers/recipe");

// this is for login
router.get('/', mainCntl.index);
router.get('/login',mainCntl.get_login);
router.post('/login', mainCntl.post_login);

// this is for control
router.get('/user/index', userCntl.index)


// This is for recipes
router.get('/recipes', recipeCntl.get_search);
router.post('/recipes', recipeCntl.post_search);
module.exports = router;
