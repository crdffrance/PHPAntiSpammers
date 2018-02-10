	///////////////////////////////
	// INSTALLATION
	///////////////////////////////
	
	PHP Anti Spammers v3.0 Documentation.
	Droits de reproduction et de diffusion réservés. International Copyright © 2000 - 2010 CRDF All Rights Reserved.
	
	A - Qu'est-ce que PHP Anti Spammers ?
	=====================================
	
	Le nombre de spams et de virus circulant via les messageries est en constante augmentation.
	Au plus votre adresse e-mail est diffusée sur Internet et vous recevez ce genre de courrier indésirable.
	Par ailleurs, quand vous affichez des mails de ce type, il arrive que le spammeur soit averti que vous avez lu son mail,
	ce qui provoque l'ajout de votre adresse e-mail dans plusieurs autres listes...
	
	Vous devez donc prendre des mesures pour mettre fin à ce fléau qui vous fait perdre du temps à chaque fois que vous consultez votre messagerie.

	C'est l'objectif de PHP Anti Spammers, une application anti-spam externalisée entièrement gratuite (open source), développée en PHP.

	Alors que la plupart des applications anti-spam ne savent reconnaître qu'une petite partie du courrier indésirable envoyé sur vos adresses email,
	la multitude de filtres et règles intégrées dans PHP Anti Spammers lui permet d'obtenir des performances allant jusqu'à 99,6 % de réussite.
	
	B - Configuration nécessaire :
	==============================
	
	* Système d'exploitation : Windows, Linux, FreeBSD et Mac.
	* Compatible avec les versions de PHP 3, 4 et 5.
	* PHP-CLI (recommandé) : Module PHP Console.
	* PHP-IMAP (obligatoire) : Module PHP Imap.
	* Serveur de messagerie : POP3, POP3, IMAP et IMAPS.
	* Windows : Tâches automatisées. Autres : CRONTAB.
	* Serveur dédié recommandé.
	
	C - Installation de PHP Anti Spammers :
	=======================================
	
	PHP Anti Spammers est une application très flexible, il peut donc être installer sur plusieurs configuration.
	PHP Anti Spammers peut-être installé sur Windows, Linux, FreeBSD et Unix.
	
	Différentes architectures :
	* Serveurs dédiés
	* Serveurs mutualisés
	* Serveur privés
	
		C.1. Installation sur un système Linux/Unix (RECOMMANDE) :
		==========================================================
		
		Cette installation est réservée aux puristes qui souhaitent installer PHP Anti Spammers de manière efficace.
		PHP Anti Spammers a été testé sous cette configuration.
		
		- Créez un utilisateur unix du nom de "phpantispammers" ;
		- Décompressez les fichiers dans /home/phpantispammers/ ;
		- Mettez un CHMOD 700 sur le répertoire /home/phpantispammers/ ;
		- Mettez un CHMOD 600 sur les fichiers suivants :
			* /home/phpantispammers/core/config.PHPAntiSpammers.php
			* /home/phpantispammers/core/email_answer.PHPAntiSpammers.php
			* /home/phpantispammers/core/filter.personnal.PHPAntiSpammers.php
		
		- Mettez un CHMOD 700 sur les fichiers suivants :
			* /home/phpantispammers/core/functions.PHPAntiSpammers.php
			* /home/phpantispammers/core/filter.PHPAntiSpammers.php
			* /home/phpantispammers/launch.PHPAntiSpammers.php
			* /home/phpantispammers/update.PHPAntiSpammers.php
		
		- Et sur les repertoires suivants :
			* /home/phpantispammers/data/stock_uid/
			* /home/phpantispammers/data/stock_uid_msg/
		
		- Rajoutez les lignes suivantes dans CRON (crontab -e -u phpantispammers) :
		
		*/2 * * * *     /usr/bin/php5 /home/phpantispammers/launch.PHPAntiSpammers.php > /dev/null
		30 23 * * *     /usr/bin/php5 /home/phpantispammers/update.PHPAntiSpammers.php > /dev/null
		
		Note : tapez which php5 pour connaître le chemin du binaire PHP (paquet PHP-CLI).
		
		L'installation est maintenant terminée, il en reste plus qu'à configurer PHP Anti Spammers.
		Rendez-vous au chapitre D pour la configuration ;).
		
		C.2. Installation sur un système Windows (NON RECOMMANDE) :
		===========================================================
		
		Nous vous déconseillons vivement d'utiliser les logiciels suivants :
			* EasyPHP
			* WAMP
			
		PHP Anti Spammers fonctionne correctement sur ces logiciels, mais nous les considérons comme instable.
		Préférez plutôt les paquets officiels de PHP ;).
		
		- Décompressez les fichiers dans c:\PHPAntiSpammers\ ;
		- Téléchargez Windows Binaries de PHP 3, 4, 5, 6 :
			* http://fr.php.net/downloads.php
		
		Il vous reste plus qu'à configurer les tâches automatisées dans le TASKMANAGER de Windows.
		
	D - Configuration de PHP Anti Spammers :
	========================================
	
	La configuration est très simple. Il vous suffit de modifier les différents
	paramètres dans le fichier 'core/config.PHPAntiSpammers.php'.
	
	Pour plus d'informations sur chacun des filtres, merci de bien vouloir consulter la documentation.
	
	E - Tester PHP Anti Spammers :
	==============================
	
	Pour tester PHP Anti Spammers, deux solutions s'offrent à vous :
		* La tâche automatisée va se déclencher toute seule et lancer automatiquement PHP Anti Spammers si votre configuration est correcte ;
		* Forcer le lancement ;
		
	Pour forcer le lancement, merci de bien vouloir exécuter le fichier "launch.PHPAntiSpammers.php".
	
	Vous pourrez voir quelles règles ont été utilisées et qu'est-ce qui a déclenché
	la détection d'un spam dans les mails scannés (la dernière ligne du header affichée).
	
	F - Mise à jour des bases anti-spam :
	=====================================
	
	PHP Anti Spammers est livré sans aucune bases anti-spam, il n'est donc pas du tout efficace puisque aucune règle filtrage n'existe.
	Il faut donc télécharger et mettre à jour les dernières bases anti-spam de CRDF Labs.
	
	Chez CRDF, le laboratoire de prévention des menaces détecte et développe les mises à jour nécessaires pour le filtrage de tous les spams.
	Les équipes de développement CRDF travaillent sans relâche pour vous apporter une efficacité de protection optimale.
	
	Pour ce faire, vous devez obtenir une clef MAJ en vous enregistrant à cette adresse Web :
	
	>>>> http://www.crdf.fr/product/phpantispammers/getkey/ <<<<
	
	La clef MAJ se présente sous la forme d'un numéro de série : xxxxxxxx.xxxxxxxx.xxxxxxxx.
	
	Sans cette clef MAJ, vous ne pourrez pas obtenir les dernières mises à jour et vous ne pourrez pas participer à la CRDF Blacklist Community (voir chapitre G).
	
	Une fois l'activation de votre clef MAJ, vous devez la copier dans le fichier de configuration de l'application ('core/config.PHPAntiSpammers.php') et
	modifier cette variable :
	
	$PHPAntiSpammers['KeyMAJ'] = "xxxxxxxx.xxxxxxxx.xxxxxxxx";
	
	Vous pouvez mettre les filtres à jour manuellement ou automatiquement (crontab/taskmanager)
	en exécutant le fichier 'update.PHPAntiSpammers.php'.
	
	Le service updater de PHP Anti Spammers se connecte aux serveurs de PHP Anti Spammers afin de vérifier :
		* la version globale de PHP Anti Spammers ;
		* la version des bases anti-spam ;
		
	Si la version des bases anti-spam ne correspond pas avec celle installée sur votre serveur, le service updater va automatiquement télécharger
	et installer les nouvelles bases anti-spam.
	
	Le servie updater a été conçu pour fonctionner en console mais vous pouvez aussi le faire fonctionner en mode graphique depuis un navigateur Web.
	Cependant, vous devrez ouvrir la source de la page Web afin d'y voir les logs.
	
	Les bases anti-spam sont contenues dans un seul fichier 'core/filter.PHPAntiSpammers.php'.
	Les bases anti-spam sont compressées avec base64.
	
	G - CRDF Blacklist Community :
	==============================
	
	CRDF Blacklist Community est une base de données contenant les adresses IP utilisées par les spammeurs.
	
	Cette base de données est constament mise à jour grâce à la communauté des utilisateurs de PHP Anti Spammers.
	Dès qu'un utilisateur (uniquement si l'option est activée dans la configuration) de PHP Anti Spammers reçoit un spam, l'adresse IP
	est ajoutée une heure plus tard dans les bases anti-spam.
	
	Les adresses IP sont analysées par un moteur complexe qui décide en fonction de l'échelle de spammicité de bannir
	ou non une adresse IP entière (255.255.XXX.XXX).
	
	Bien entendu, afin de pouvoir participer à la CRDF Blacklist Community vous devez obtenir une clef MAJ valide.
	Si vous ne savez pas comment obtenir une clef MAJ, merci de bien vouloir vous rendre au chapitre F.
	
	Si un spam n'est pas détecté par PHP Anti Spammers, merci de bien vouloir nous le faire savoir en nous le soumettant à l'adresse :
	
	>>>> http://www.crdf.fr/product/phpantispammers/reportspam/ <<<<
	
	AVERTISSEMENT :
	
	Lorsque la fonction de CRDF Blacklist Community est activée, PHP Anti Spammers effectue des échanges entre vous et les serveurs de CRDF.
	PHP Anti Spammers envoie uniquement les adresses IP des spammeurs.
	
	Si vous utilisez nos bases anti-spam, nous vous remercions de bien vouloir activer la fonction CRDF Blacklist Community car celle-ci
	permet à tous les usagers de PHP Anti Spammers d'avoir une protection beaucoup plus efficace.
	
	Nous pensons ne mettre aucune limitation sur le téléchargement des bases anti-spam. S'il s'avère q'un nombre élevé d'usagers n'activent pas la fonction, 
	nous serons dans l'obligation d'instaurer des obligations pour pouvoir obtenir nos bases anti-spam.
	
	H - Besoin d'aide pour l'installation ?
	=======================================
	
	Vous souhaitez que nous réalisions l'installation pour vous sur votre serveur ? Nous pouvons le faire pour vous. Contactez-nous pour en savoir plus !
	
	>>>> http://www.crdf.fr/contact <<<<
	
	I - Licence d'utilisation :
	===========================
	
	PHP Anti Spammers est distribué sous licence "CONTRAT DE LICENCE DE LOGICIEL LIBRE CeCILL".
	Cette licence est une variante de la licence GPL sauf qu'elle ait régit par le droit Français et internationnal.
	
	En respectant la licence CeCILL, vous respectez notre travail.
	En respectant notre travail, vous encouragez CRDF a développer PHP Anti Spammers ainsi que d'autres applications à but non lucratives.
	
	Tout simplement, merci de bien vouloir respecter notre travail.
	
	PHP Anti Spammers est donc bien open source ;).
	
	J - Je viens de trouver un bug, comment faire ?
	===============================================
	
	Malgré tous nos tests, il est possible que nous laissions passer quelques bugs.
	Si vous êtes témoin d'un bug, merci de bien vouloir nous le signaler en nous écrivant :
	
	>>> http://www.crdf.fr/contact <<<
	
	Vous pouvez aussi nous contacter directement par email au webmaster-AT-crdf.fr.
	Egalement par téléphone au 01.83.64.00.03 (prix d'un appel local).
	
	K - Auteurs :
	=============
	
	=====> CRDF France <=====
	
	CRDF, web agency spécialisée dans la création de sites web depuis 2000 vous accompagne
	et vous conseille pour faire de votre projet internet une réussite.
	
	Agence Web depuis 2000.
	
	Service clients : clients@crdf.fr
	Service commercial : commercial@crdf.fr
	Service technique : webmaster@crdf.fr
	
	Tél : 01.83.64.00.03.
	
	=====> G. Jocelyn <=====
	
	Développeur de CRDF.
	
	L - Remerciements :
	===================
	
	Merci de votre fidélité et de la confiance dont vous nous témoignez.
	Si vous avez des suggestions et/ou des idées quant au développement de PHP Anti Spammers, merci de bien vouloir nous contacter :).
