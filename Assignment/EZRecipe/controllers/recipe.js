function getDishName(req)
{
    var dishName = req.param('dishName');

    return  dishName;
}

module.exports.get_search = function(req, res)
{
  res.render('recipes');
};

/*
 * POST text fields page.
 */
module.exports.post_search = function(req, res)
{
    var text = getDishName(req);
    res.send({recipes: text});
};
