/**
 * Send the contents of an HTML page to the client.
 * @param fileName the name of the file containing the HTML page.
 * @param result the HTTP result.
 */

module.exports.index = function(req, res, next) {
  res.render('index', { title: 'EZRecipes' });
}


module.exports.get_login = function(req, res, next) {
  res.render('login');
}
module.exports.post_login = function(req, res, next) {
    res.redirect("/user/index" );
};

// /**
//  * Extract the first and last names from the request.
//  * @param request the HTTP request.
//  * @returns a string containing the first and last names.
//  */
// function getDishName(request)
// {
//     var dishName = request.param('dishName');

//     return 'This is the recipe for ' + dishName + ".";
// }

// /*
//  * GET home page.
//  */
// module.exports.home = function(request, result)
// {
//     sendPage('index.html', result);
// };

// /*
//  * GET text fields page.
//  */
// module.exports.get_login = function(request, result)
// {
//     sendPage('login.html', result);
// };

// /*
//  * POST text fields page.
//  */
// module.exports.post_login = function(request, result)
// {
//     var text = '    Hello, ' + getAccountInformation(request);
//     sendBody(text, result);
// };

// /*
//  * GET text fields page.
//  */
// module.exports.get_search = function(request, result)
// {
//     sendPage('search.html', result);
// };

// /*
//  * POST text fields page.
//  */
// module.exports.post_search = function(request, result)
// {
//     var text = getDishName(request);
//     sendBody(text, result);
// };
