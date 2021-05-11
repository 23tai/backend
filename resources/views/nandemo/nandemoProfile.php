<?php

    // 自分のアカウントのallを年代別に取得、、こうやってわざわざ先にfirst()で取っときて
        // 変数に代入しないと、その先のリレーションがカラムを取得と勘違いされてしまう。
        // $allEra1 = $myAccount->alls()->where('era_id', 1)->first();
        // $allEra2 = $myAccount->alls()->where('era_id', 2)->first();
        // $allEra3 = $myAccount->alls()->where('era_id', 3)->first();
        // $allEra4 = $myAccount->alls()->where('era_id', 4)->first();



        // allのチームidがある → つまりチームが登録されていたらそのチーム名を代入して、ポジションも代入する
        // 無かったら空と1を代入する
        // $elementaryTeam = $myAccount->alls()->where('era_id', 1)->first()->team->team_name;
        // $elementaryPosition = $myAccount->alls()->where('era_id', 1)->first()->position_id;

        // $juniorHighTeam = $allEra2->team->team_name;
        // $juniorHighPosition = $allEra2->position_id;

        // $highTeam = $allEra3->team->team_name;
        // $highPosition = $allEra3->position_id;

        // $universityTeam = $allEra4->team->team_name;
        // $universityPosition = $allEra4->position_id;

        // $elementaryTeam = $myAccount->returnTeamName(1);
        // $elementaryPosition = $myAccount->returnPositionId(1);

        // $juniorHighTeam = $myAccount->returnTeamName(2);
        // $juniorHighPosition = $myAccount->returnPositionId(2);

        // $highTeam = $myAccount->returnTeamName(3);
        // $highPosition = $myAccount->returnPositionId(3);

        // $universityTeam = $myAccount->returnTeamName(4);
        // $universityPosition = $myAccount->returnPositionId(4);

        // //    これはprofile.blade.php側で使うやつbladeで定義はいけてないからここで作る。
        // $schools = array(
        //     array('小学校の所属チーム', 'elementaryTeam', 'elementaryPosition', $elementaryTeam, $elementaryPosition),
        //     array('中学校の所属チーム', 'juniorHighTeam', 'juniorHighPosition', $juniorHighTeam, $juniorHighPosition),
        //     array('高校の所属チーム', 'highTeam', 'highPosition', $highTeam, $highPosition),
        //     array('大学の所属チーム', 'universityTeam', 'universityPosition', $universityTeam, $universityPosition)
        // );

        $schools = Profile::returnSchoolsArrayes($myAccount);










            // $schools = array(
            //     array(1, $request->elementaryTeam, $request->elementaryPosition),
            //     array(2, $request->juniorHighTeam, $request->juniorHighPosition),
            //     array(3, $request->highTeam, $request->highPosition),
            //     array(4, $request->universityTeam, $request->universityPosition)
            // );

            // foreach ($schools as $school) {

            //     // まずprofileでユーザーがチーム名を入力したかを年代別に確かめる、入力してたら次の処理をする
            //     if ($school[1]) {

            //         // 入力したチーム名のteamsテーブルのカラム一つ
            //         $teamAlready = Team::where('team_name', $school[1])->first();

            //         // 既にteamsテーブルに入力されたチーム名があるかを確認する、なかったらそのチーム名をteamsテーブル新規追加する。
            //         // そしてそのidを取ってくる
            //         // あったら既存のそのidを取ってくる
            //         if ($teamAlready) {
            //             $team_id = $teamAlready->id;
            //         } else {
            //             $team = new Team();
            //             $team->team_name = $school[1];
            //             $team->save();

            //             $theTeam = Team::where('team_name', $school[1])->first();
            //             $team_id = $theTeam->id;
            //             // ここではどっちにしろデフォルトの 1 か今teamsテーブルに入れたチームのidかが$team_idに入っている。
            //         }
            //         // 上↑はteamsテーブルへのチームの登録処理、、とそのidの取得（そのidを自分をallsテーブルに入れるから）



            //         // そいつがもう既にチームを登録しているかを確認（年代別に確認）
            //         //  既に登録していたら上書き していなかったら新しく作って保存
            //         $all = All::where('user_id', $myId)->where('era_id', $school[0])->first();
            //         // era_idだけだと、チーム名が入力されていなくても登録されるためちゃんとチームidで調べ
            //         $all->team_id = $team_id;

            //         $all->position_id = $school[2];

            //         $all->save();
            //     } // if ($school[1])

            // } // foreach
            Profile::saveTeamAndPosition($request, $myId);








            // ここでもしユーザーが入力してたら登録
            // $columns = array('user_name', 'introduction', 'age', 'area_id');
            // foreach ($columns as $column) {
            //     if (isset($request->$column)) {
            //         $myAccount->$column = $request->$column;
            //         $myAccount->save();
            //     }
            // }
            Profile::saveNameIntroductionAgeArea($request, $myAccount);









            public function saveTeamAndPosition($request, $myId)
            {
              $schools = array(
                array(1, $request->elementaryTeam, $request->elementaryPosition),
                array(2, $request->juniorHighTeam, $request->juniorHighPosition),
                array(3, $request->highTeam, $request->highPosition),
                array(4, $request->universityTeam, $request->universityPosition)
              );
          
              foreach ($schools as $school) {
          
                // まずprofileでユーザーがチーム名を入力したかを年代別に確かめる、入力してたら次の処理をする
                if ($school[1]) {
          
                  // 入力したチーム名のteamsテーブルのカラム一つ
                  // $teamAlready = Team::where('team_name', $school[1])->first();
                  $teamAlready = Team::TeamNameEqual($school[1])->first();
          
                  // 既にteamsテーブルに入力されたチーム名があるかを確認する、なかったらそのチーム名をteamsテーブル新規追加する。
                  // そしてそのidを取ってくる
                  // あったら既存のそのidを取ってくる
                  if ($teamAlready) {
                    $team_id = $teamAlready->id;
                  } else {
                    $team = new Team();
                    // $team->team_name = $school[1];
                    // $team->save();
                    $team->saveTeam($school[1]);
          
                    // $theTeam = Team::where('team_name', $school[1])->first();
                    // $team_id = $theTeam->id;
                    // $theTeam = Team::where('team_name', $school[1])->first();
                    $team_id = Team::where('team_name', $school[1])->first()->id;
                    // ここではどっちにしろデフォルトの 1 か今teamsテーブルに入れたチームのidかが$team_idに入っている。
                  }
                  // 上↑はteamsテーブルへのチームの登録処理、、とそのidの取得（そのidを自分をallsテーブルに入れるから）
          
          
          
                  // そいつがもう既にチームを登録しているかを確認（年代別に確認）
                  //  既に登録していたら上書き していなかったら新しく作って保存  →どっちみち上書き
                  // $all = All::where('user_id', $myId)->where('era_id', $school[0])->first();
                  $all = All::myIdEraEqual($myId, $school[0])->first();
                  // era_idだけだと、チーム名が入力されていなくても登録されるためちゃんとチームidで調べ
                  // $all->team_id = $team_id;
          
                  // $all->position_id = $school[2];
          
                  // $all->save();
                  $all->saveTeamIdAndPositionId($team_id, $school[2]);
                } // if ($school[1])
          
              } // foreach
          
            }
          



