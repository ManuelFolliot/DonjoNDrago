# Modèle conceptuel de données
## MCD V1

Has2, 11 CHARACTER, 0N CLASS
CLASS: class_name, class_description

CHARACTER: character_name, character_avatar_url, level, life_points, age, background, alignement, stat_strength, stat_dexterity, stat_endurance, stat_intelligence, stat_wisdom, stat_charisma
Has1, 11 CHARACTER, 0N RACE

USER: pseudo, email, password, user_avatar_url
Creates, 0N USER, 11 CHARACTER
RACE: race_name, race_description, strength_modifier, dextirity_modifier, endurance_modifier, intelligence_modifier, wisdom_modifier, charisma_modifier


## MCD V2

:
ENNEMIES: name, lifepoints, attacks, evasion
:
:
:
AMBIANCE_IMAGES: ambiance_name, img_url
INCLUDES, 0N CAMPAIGN, 0N ENNEMIES
:
Has2, 11 CHARACTER, 0N CLASS
CLASS: class_name, class_description

Has3, 0N AMBIANCE_IMAGES, 01 CAMPAIGN
CAMPAIGN: campaign_name
Plays, 0N CHARACTER, 0N CAMPAIGN
CHARACTER: character_name, character_avatar, level, life_points, age, background, alignement, stat_strength, stat_dexterity, stat_endurance, stat_intelligence, stat_wisdom, stat_charisma
Has1, 11 CHARACTER, 0N RACE
:
Leads, 0N USER, 0N CAMPAIGN
USER: pseudo, email, password, user_avatar
Creates, 0N USER, 11 CHARACTER
RACE: race_name, race_description, strength_modifier, dextirity_modifier, endurance_modifier, intelligence_modifier, wisdom_modifier, charisma_modifier
