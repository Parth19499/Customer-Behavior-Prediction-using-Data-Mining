-->FPG.py is a python file which recommends items based on user's previously bought items(history).

-->We have used FP-Growth algorithm to find frequently associated items and extract strong association rules from it.

-->You can change values of min_support and min_confidence parameters as per requirement.

-->We have used store_data.csv as our dataset for training and generating strong rules between items.

-->In the backend a database is maintained for each user. It has information about purchase history of a particular user.

-->The login portal and front-end part is implemented in HTML,CSS,Javascript while the backend part is implemented in PHP.

-->store_data.csv contains some food items that are bought together from local super market.

-->Program output contains 4 recommendation based on history or if no history is found then it will print 4 most frequently bought items from whole dataset.

--><<How To run>>
	-->Open command prompt.
	-->Make a directory 
		-->e.g, C:\Users\system>mkdir RecommendationSystem
	-->Put store_data.csv and FPG.py in that directory.
	-->Navigate to the directory which you have just created.
		-->e.g, C:\Users\system>cd RecommendationSystem
	-->Type python FPG.py "<item list separated by comma>" 
		-->e.g, C:\Users\system\RecommendationSystem> python FPG.py "eggs,milk,avocado"
	-->Don't forget to put double quotes around item list.
	-->Output will print recommendations.
